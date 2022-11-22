<?php

namespace Framework\Routing\Router;

interface RouterInterface
{
    public function match(string $uri);

}