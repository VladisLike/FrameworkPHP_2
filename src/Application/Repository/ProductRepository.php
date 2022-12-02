<?php

namespace Application\Repository;

use Application\Model\Product;
use Framework\Repository\AbstractRepository;

class ProductRepository extends AbstractRepository
{

    public function getModel(): string
    {
        return Product::class;
    }
}