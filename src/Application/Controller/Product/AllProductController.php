<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataApi;
use Framework\Repository\DataResource\DataFilePHP;
use Framework\Repository\DataResource\DataMySQL;

class AllProductController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $data = new DataApi('https://127.0.0.1:8000/api/products.json');
        $repository = new ProductRepository($data/*new DataFilePHP()*/);
        /** @var Product[] $cars */
        $products = $repository->findAll();

        return new JsonResponse($products);
    }
}