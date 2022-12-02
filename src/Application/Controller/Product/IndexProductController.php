<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataFilePHP;
use Framework\Repository\DataResource\DataMySQL;

class IndexProductController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $data = new DataMySQL('localhost', 'root', 'secret', 'framework_db');
        $repository = new ProductRepository($data);
        /** @var Product $car */
        $product = $repository->find($id);


        return new JsonResponse($product);
    }
}