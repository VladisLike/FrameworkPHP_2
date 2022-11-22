<?php

namespace Application\Model;


use Framework\Common\Model;

class Product extends Model
{
    private string $name;

    private int $cost;

    private int $discount;

    private bool $inStock;

    public function __construct(
        int $id,
        string $name,
        int    $cost,
        int    $discount,
        bool   $inStock
    )
    {
        parent::__construct($id);

        $this->name = $name;
        $this->cost = $cost;
        $this->discount = $discount;
        $this->inStock = $inStock;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    public function isInStock(): bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }
}