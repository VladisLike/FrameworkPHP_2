<?php

namespace Framework\Http\Request;

class Request implements RequestInterface
{
    private array $params;
    private array $attributes = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function withAttribute($attribute, $value): self
    {
        $new = clone $this;
        $new->attributes[$attribute] = $value;
        return $new;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute($attribute, $default = null)
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            return $default;
        }

        return $this->attributes[$attribute];
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