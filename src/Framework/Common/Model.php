<?php

namespace Framework\Common;

abstract class Model implements \JsonSerializable
{
    protected int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}