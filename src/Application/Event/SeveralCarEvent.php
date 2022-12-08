<?php

namespace Application\Event;

use Framework\EventDispatcher\Event;

class SeveralCarEvent implements Event
{
    public const NAME = 'several_car.event';

    private array $cars;

    public function __construct(array $cars)
    {
        $this->cars = $cars;
    }

    public function getCars(): array
    {
        return $this->cars;
    }
}