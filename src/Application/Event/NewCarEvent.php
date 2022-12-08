<?php

namespace Application\Event;

use Application\Model\Car;
use Framework\EventDispatcher\Event;

class NewCarEvent implements Event
{
    public const NAME = 'new_car.event';

    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function getCar(): Car
    {
        return $this->car;
    }
}