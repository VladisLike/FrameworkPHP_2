<?php

namespace Framework\Http\Request;

class Request implements RequestInterface
{
    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function withParams(array $query)
    {
        $this->params = $query;
    }

    public function getUriPath(): string
    {
        $uri = $this->params['REQUEST_URI'];
        if (preg_match("/^[a-zA-Z0-9]+$/", explode('/', $uri)[1])) {
            return $uri;
        } else {
            return '/';
        }
    }

}