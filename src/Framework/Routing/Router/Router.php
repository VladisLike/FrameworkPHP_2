<?php

namespace Framework\Routing\Router;


use Framework\Routing\RouteCollection;

class Router implements RouterInterface
{
    private RouteCollection $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(string $uri)
    {

    }

}