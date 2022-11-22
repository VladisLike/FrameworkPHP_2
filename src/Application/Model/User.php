<?php

namespace Application\Model;


use Framework\Common\Model;

class User extends Model
{
    private string $firstName;

    private string $lastName;

    private string $email;

    private bool $active;

    private array $products;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        bool $active,
        array $products
    )
    {
        parent::__construct($id);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->active = $active;
        $this->products = $products;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}