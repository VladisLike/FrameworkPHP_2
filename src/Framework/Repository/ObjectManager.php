<?php

namespace Framework\Repository;

class ObjectManager
{
    private array $components = [];

    private array $data;

    public function __construct(string $model)
    {
        $this->configure($model);
    }

    private function configure(string $model): void
    {
        $reflection = new \ReflectionClass($model);
        $this->data = require PATH . '/data/' .
            strtolower($reflection->getShortName()) . 's.php';
    }

    public function getData(): array
    {
        return $this->data;
    }

}