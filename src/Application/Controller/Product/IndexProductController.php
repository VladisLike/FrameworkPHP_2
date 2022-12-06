<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataMySQL;

class IndexProductController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $data = new DataMySQL('localhost', 'root', 'secret', 'exampleApi_db');
        $repository = new ProductRepository($data);
        /** @var Product $car */
        $product = $repository->find($id);


        return $product === null ? new Response('<h1>Not Found!</h1>') : new JsonResponse($product);
    }
}