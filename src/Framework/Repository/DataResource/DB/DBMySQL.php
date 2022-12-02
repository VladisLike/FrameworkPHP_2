<?php

namespace Framework\Repository\DataResource\DB;

use mysqli;

class DBMySQL implements DB
{
    private mysqli $link;
    public $prefix;

    public function __construct($host, $username, $password, $database, $prefix = '', $names = 'utf8')
    {
        $this->connect($host, $username, $password, $database);
        $this->execute('SET NAMES "' . $this->escape($names) . '"');
        $this->prefix = $prefix;
    }

    private function connect($host, $username, $password, $database)
    {
        if (!$this->link = mysqli_connect($host, $username, $password)) {
            print_r("Unable to connect to DB" . mysqli_connect_error());
            exit;
        }

        if (!mysqli_select_db($this->link, $database)) {
            print_r("Unable to choose database" . mysqli_connect_error());
            exit;
        }
    }

    public function execute(string $sql)
    {
        mysqli_query($this->link, $sql);
        $this->checkErrors();
    }

    public function query(string $sql): array
    {
        $result = mysqli_query($this->link, $sql);
        $this->checkErrors();
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    private function checkErrors()
    {
        if (mysqli_errno($this->link)) {
            print_r(mysqli_error($this->link));
            exit;
        }
    }

    public function escape(string $value): string
    {
        return mysqli_real_escape_string($this->link, $value);
    }

    public function affected()
    {
        return mysqli_affected_rows($this->link);
    }

    public function insertId()
    {
        return mysqli_insert_id($this->link);
    }

}