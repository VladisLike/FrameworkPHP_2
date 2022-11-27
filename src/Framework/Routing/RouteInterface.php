<?php

namespace Framework\Routing;

use Framework\Http\Request\RequestInterface;
use Framework\Routing\Router\Result;

interface RouteInterface
{
    public function match(RequestInterface $request): ?Result;

}