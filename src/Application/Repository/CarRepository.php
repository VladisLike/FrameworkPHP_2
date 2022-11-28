<?php

namespace Application\Repository;

use Application\Model\Car;
use Framework\Repository\AbstractRepository;

class CarRepository extends AbstractRepository
{

    function getModel(): string
    {
        return Car::class;
    }
}