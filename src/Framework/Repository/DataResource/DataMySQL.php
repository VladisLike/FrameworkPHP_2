<?php

namespace Framework\Repository\DataResource;

class DataMySQL implements DataInterface
{
    private string $host;
    private string $username;
    private string $password;
    private string $dbName;

    public function __construct(string $host, string $username, string $password, string $dbName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function getDataFromResource(string $modelName): array
    {
        $link = \mysqli_connect($this->host, $this->username, $this->password, $this->dbName);
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