<?php

namespace Framework\Repository\DataResource;

use Framework\DB\DBMySQL;

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
        $db = new DBMySQL($this->host, $this->username, $this->password, $this->dbName);
        $explodedName = explode('\\', $modelName);
        $model = $explodedName[count($explodedName) - 1] . 's';
        $sql = "SELECT * FROM " . strtolower($model);
        return $db->query($sql);
    }
}