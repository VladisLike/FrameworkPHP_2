<?php

namespace Framework\Routing;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function any(string $name, string $path, $handler): void
    {
        $this->routes[] = new Route($name, $path, $handler, []);
    }

    public function get(string $name, string $path, $handler): void
    {
        $this->routes[] = new Route($name, $path, $handler, ['GET']);
    }

    public function post(string $name, string $path, $handler): void
    {
        $this->routes[] = new Route($name, $path, $handler, ['POST']);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }


}