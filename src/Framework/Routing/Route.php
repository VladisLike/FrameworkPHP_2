<?php

namespace Framework\Routing;

class Route
{
    private string $name;
    private string $path;
    private $handler;
    private array $methods;

    public function __construct(string $name, string $path, $handler, array $methods)
    {
        $this->name = $name;
        $this->path = $path;
        $this->handler = $handler;
        $this->methods = $methods;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

}