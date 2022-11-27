<?php

namespace Framework\Routing;

use Framework\Http\Request\RequestInterface;
use Framework\Routing\Router\Result;

class Route implements RouteInterface
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

    public function match(RequestInterface $request): ?Result
    {
        if (empty($this->methods)) {
            return null;
        }

        if ($request->getUriPath() === $this->path) {
            return new Result($this->name, $this->handler);
        }

        return null;
    }

}