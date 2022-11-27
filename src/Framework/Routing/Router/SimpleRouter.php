<?php

namespace Framework\Routing\Router;

use Framework\Http\Request\RequestInterface;
use Framework\Routing\Exception\NotMatchedException;
use Framework\Routing\RouteCollection;

class SimpleRouter implements RouterInterface
{
    private RouteCollection $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(RequestInterface $request): ?Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($result = $route->match($request)) {
                return $result;
            }
        }
        throw new NotMatchedException($request);
    }

}