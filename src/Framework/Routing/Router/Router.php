<?php

namespace Framework\Routing\Router;

use Framework\Http\Request;
use Framework\Routing\Exception\NotMatchedException;
use Framework\Routing\Result;
use Framework\Routing\RouteCollection;

class Router implements RouterInterface
{
    private RouteCollection $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request): Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($request->getUriPath() === $route->getPath()) {
                return new Result($route->getName(), $route->getHandler());
            }
        }
        throw new NotMatchedException($request);
    }

}