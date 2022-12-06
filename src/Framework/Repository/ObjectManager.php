<?php

namespace Framework\Repository;

use Framework\Common\Model;
use Framework\Helpers\SyntaxHelper;
use Framework\Repository\DataResource\DataInterface;
use ReflectionClass;

class ObjectManager
{
    private DataInterface $data;
    private ReflectionClass $targetClass;
    private AbstractRepository $repository;

    public function __construct(AbstractRepository $repository, DataInterface $data)
    {
        $reflection = new \ReflectionClass($repository->getModel());

        $this->repository = $repository;
        $this->data = $data;
        $this->targetClass = $reflection;
    }

    public function getObject(array $item): ?Model
    {
        $classProperties = $this->targetClass->getProperties();
        $properties = \array_map(function (\ReflectionProperty $property) use ($item) {
            $this->propertyAnalyses(
                $formattedProperty = SyntaxHelper::camelToSnake($property->getName()),
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


        $classes = [];
        $repoName = "Application\\Repository\\" . $className . 'Repository';
        $currentRepository = (new ReflectionClass($repoName))->newInstance($this->data);

        foreach ($objectIds as $objectId) {
            $classes[] = $currentRepository->find($objectId);
        }

        $item[$property] = $classes;

    }

    public function getDataArray(): array
    {
        return $this->data->getDataFromResource($this->repository->getModel());
    }

    public function getData(): DataInterface
    {
        return $this->data;
    }


}