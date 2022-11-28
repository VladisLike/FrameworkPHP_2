<?php

namespace Application\Model;

use Framework\Common\Model;

class Post extends Model
{
    private string $title;

    private string $description;

    /**
     * @var Car[]
     */
    private array $cars;

    /**
     * @param string $title
     * @param string $description
     * @param Car[] $cars
     * @param int $id
     */
    public function __construct(string $title, string $description, array $cars, int $id)
    {
        parent::__construct($id);

        $this->title = $title;
        $this->description = $description;
        $this->cars = $cars;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Car[]
     */
    public function getCars(): array
    {
        return $this->cars;
    }

    /**
     * @param Car[] $cars
     */
    public function setCars(array $cars): void
    {
        $this->cars = $cars;
    }


}