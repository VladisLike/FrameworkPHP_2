<?php

namespace Framework\Repository;

use Framework\Common\Model;
use Framework\Repository\DataResource\DataApi;
use Framework\Repository\DataResource\DataFilePHP;
use Framework\Repository\DataResource\DataInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    private ObjectManager $objectManager;

    public function __construct(DataFilePHP $data)
    {
        $this->objectManager = new ObjectManager($this, $data);
    }

    public function find(int $id): ?Model
    {
        foreach ($this->objectManager->getDataArray() as $item) {
            if ((int)$item['id'] === $id) {
                return $this->objectManager->getObject($item);
            }
        }

        return null;
    }

    public function findAll(): array
    {
        $models = [];

        foreach ($this->objectManager->getDataArray() as $item) {
            $models[] = $this->objectManager->getObject($item);
        }

        return $models;
    }

    public function findBy(array $criteria): array
    {
        $models = [];

        foreach ($this->objectManager->getDataArray() as $item) {
            if ($this->determineItemCompareWith($item, $criteria)) {
                $models[] = $this->objectManager->getObject($item);
            }
        }

        return $models;
    }

    protected function determineItemCompareWith(array $item, array $criteria): bool
    {
        $isCompared = true;
        $diffArray = \array_diff($item, $criteria);

        foreach ($criteria as $key => $value) {
            if (\array_key_exists($key, $diffArray)) {
                $isCompared = false;
            }
        }

        return $isCompared;
    }


    abstract function getModel(): string;

}