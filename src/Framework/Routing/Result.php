<?php

namespace Framework\Routing;

class Result
{
    private string $name;
    private $handler;

    public function __construct(string $name, $handler)
    {
        $this->name = $name;
        $this->handler = $handler;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

}