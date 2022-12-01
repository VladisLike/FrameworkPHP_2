<?php

namespace Framework\Repository;

use Framework\Common\Model;
use ReflectionClass;

class ObjectManager
{
    private array $data;
    private ReflectionClass $targetClass;
    private AbstractRepository $repository;

    private string $fileType;

    public function __construct(AbstractRepository $repository, string $fileType)
    {
        $reflection = new \ReflectionClass($repository->getModel());
        $this->repository = $repository;
        $this->fileType = $fileType;
        $this->targetClass = $reflection;

        $this->data = $this->getDataFrom($reflection, $fileType);
    }

    private function getDataFrom(ReflectionClass $reflection, string $fileType): array
    {
        $type = $fileType === 'default' ? 'php' : $fileType;
        if (strtolower($type) === 'php') {
            return require PATH . '/data/files/php/' .
                \strtolower($reflection->getShortName()) . "s.$type";
        } elseif (strtolower($type) === 'sql') {
            return $this->getFromSQL();
        } else {
            print 'No found method to get data';
            exit();
        }
    }

    private function getFromSQL(): array
    {
        $link = \mysqli_connect("localhost", "root", "secret", 'framework_db');
        if ($link) {
            $explodedName = explode('\\', $this->repository->getModel());
            $modelName = $explodedName[count($explodedName) - 1] . 's';
            $sql = "SELECT * FROM " . strtolower($modelName);
            $result = mysqli_query($link, $sql);

            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            var_dump("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
            exit;
        }
    }

    public function getObject(array $item): ?Model
    {
        $classProperties = $this->targetClass->getProperties();
        $properties = \array_map(function (\ReflectionProperty $property) use ($item) {
            $this->propertyAnalyses(
                $formattedProperty = $this->camelToSnake($property->getName()),
                $item
            );
            return $item[$formattedProperty];
        }, $classProperties);

        return $this->targetClass->newInstance(...$properties);
    }

    private function propertyAnalyses(string $property, array &$item)
    {
        if (!\is_array($item[$property])) {
            return;
        }

        $objectIds = $item[$property];
        $className = \ucfirst(\implode('', \array_slice(
            $explodedProperty = \str_split($property),
            0,
            \count($explodedProperty) - 1
        )));

        $reflection = new ReflectionClass("Application\\Model\\$className");

        $classes = [];
        $oldReflection = $this->targetClass;
        $oldDate = $this->data;
        $this->targetClass = $reflection;
        $this->data = $this->getDataFrom($reflection, $this->fileType);

        foreach ($objectIds as $objectId) {
            $classes[] = $this->repository->find($objectId);
        }

        $this->targetClass = $oldReflection;
        $this->data = $oldDate;

        $item[$property] = $classes;
    }

    private function camelToSnake(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    public function getData(): array
    {
        return $this->data;
    }


}