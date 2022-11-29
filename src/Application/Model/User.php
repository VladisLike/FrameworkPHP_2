<?php

namespace Application\Model;


use Framework\Common\Model;

class User extends Model
{
    private string $firstName;

    private string $lastName;

    private string $email;

    private bool $active;

    /**
     * @var Product[]
     */
    private array $products;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param bool $active
     * @param Product[] $products
     * @param int $id
     */
    public function __construct(string $firstName, string $lastName, string $email, bool $active, array $products, int $id)
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

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}