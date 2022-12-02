<?php

namespace Framework\Repository\DataResource;

class DataFilePHP implements DataInterface
{

    public function getDataFromResource(string $modelName): array
    {
        $explodedModel = explode('\\', $modelName);
        $model = \strtolower($explodedModel[count($explodedModel) - 1]) . "s.php";
        return require PATH . "/data/files/php/" . $model;
    }
}