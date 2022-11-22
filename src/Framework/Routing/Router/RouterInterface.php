<?php

namespace Framework\Routing\Router;

use Framework\Http\Request;
use Framework\Routing\Result;

interface RouterInterface
{
    public function match(Request $request): Result;
}