<?php

namespace Framework\Repository;

use Framework\Common\Model;
use ReflectionClass;

class ObjectManager
{
    private array $data;
    private ReflectionClass $targetClass;
    private AbstractRepository $repository;

    public function __construct(AbstractRepository $repository)
    {
        $reflection = new \ReflectionClass($repository->getModel());
        $this->data = $this->getDataByClass($reflection);
        $this->targetClass = $reflection;
        $this->repository = $repository;
    }

    private function getDataByClass(ReflectionClass $reflection): array
    {
        return require 'data/' .
            \strtolower($reflection->getShortName()) . 's.php';
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
        $this->data = $this->getDataByClass($reflection);

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