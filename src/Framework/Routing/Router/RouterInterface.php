<?php

namespace Framework\Routing\Router;

use Framework\Http\Request\RequestInterface;

interface RouterInterface
{
    public function match(RequestInterface $request): ?Result;

}