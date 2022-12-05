<?php

namespace Framework\DB;

interface DB
{
    public function execute(string $sql);

    public function query(string $sql);

    public function escape(string $value);

    public function affected();

    public function insertId();
}