<?php

namespace Framework\Routing;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function any(string $name, string $path, $handler, array $tokens = []): void
    {
        $this->addRoute(new Route($name, $path, $handler, [], $tokens));
    }

    public function get(string $name, string $path, $handler, array $tokens = []): void
    {
        $this->addRoute(new Route($name, $path, $handler, ['GET'], $tokens));
    }

    public function post(string $name, string $path, $handler, array $tokens = []): void
    {
        $this->addRoute(new Route($name, $path, $handler, ['POST'], $tokens));
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

}