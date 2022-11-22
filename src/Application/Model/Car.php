<?php

namespace Application\Model;


use Framework\Common\Model;

class Car extends Model
{
    private string $make;

    private string $model;

    private string $generation;

    private bool $active;

    private array $users;

    public function __construct(int $id, string $make, string $model, string $generation, bool $active, array $users)
    {
        parent::__construct($id);

        $this->make = $make;
        $this->model = $model;
        $this->generation = $generation;
        $this->active = $active;
        $this->users = $users;
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->make;
    }

    /**
     * @param string $make
     */
    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getGeneration(): string
    {
        return $this->generation;
    }

    /**
     * @param string $generation
     */
    public function setGeneration(string $generation): void
    {
        $this->generation = $generation;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}