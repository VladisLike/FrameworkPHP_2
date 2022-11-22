<?php

namespace Application\Model;


use Framework\Common\Model;

class Post extends Model
{
    private string $title;

    private string $description;

    private array $cars;

    public function __construct(int $id, string $title, string $description, array $cars)
    {
        parent::__construct($id);

        $this->title = $title;
        $this->description = $description;
        $this->cars = $cars;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getCars(): array
    {
        return $this->cars;
    }

    /**
     * @param array $cars
     */
    public function setCars(array $cars): void
    {
        $this->cars = $cars;
    }


}