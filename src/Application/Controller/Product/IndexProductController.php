<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;

class IndexProductController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new ProductRepository();
        /** @var Product $car */
        $product = $repository->find($id);
        dump($product);
        exit();

        return new Response($product);
    }
}