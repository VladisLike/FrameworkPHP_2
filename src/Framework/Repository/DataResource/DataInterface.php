<?php

namespace Framework\Repository\DataResource;

interface DataInterface
{
    public function getDataFromResource(string $modelName): array;

}