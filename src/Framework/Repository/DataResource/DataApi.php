<?php

namespace Framework\Repository\DataResource;

use Framework\Helpers\SyntaxHelper;

class DataApi implements DataInterface
{
    private string $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }


    public function getDataFromResource(string $modelName): array
    {
        return array_map(function ($curMap) {
            return $this->renameArrKey($curMap);
        }, json_decode(file_get_contents($this->apiUrl), true));
    }

    private function renameArrKey(array $arr): array
    {
        $result = [];
        foreach ($arr as $newKey => $value) {
            $result[SyntaxHelper::camelToSnake($newKey)] = $value;
        }
        return $result;
    }
}