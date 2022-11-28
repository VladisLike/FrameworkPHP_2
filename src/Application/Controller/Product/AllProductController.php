<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\ResponseInterface;

class AllProductController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new ProductRepository();
        /** @var Product[] $cars */
        $products = $repository->findAll();
        dump($products);
        exit();

        return new Response($products);
    }
}