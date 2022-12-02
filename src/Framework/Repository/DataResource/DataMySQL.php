<?php

namespace Framework\Repository\DataResource;

class DataMySQL implements DataInterface
{

    public function getDataFromResource(string $modelName): array
    {
        $link = \mysqli_connect("localhost", "root", "secret", 'framework_db');
        if ($link) {
            $explodedName = explode('\\', $modelName);
            $model = $explodedName[count($explodedName) - 1] . 's';
            $sql = "SELECT * FROM " . strtolower($model);
            $result = mysqli_query($link, $sql);

            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            var_dump("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
            exit;
        }
    }
}