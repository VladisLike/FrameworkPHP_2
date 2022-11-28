<?php

namespace Framework\Repository;

use Framework\Common\Model;

interface RepositoryInterface
{
    public function find(int $id): ?Model;

    public function findAll(): array;

    public function findBy(array $criteria): array;

}