<?php

namespace Application\Controller\Product;

use Application\Model\Product;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\ObjectManager;

class ShowProductController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $object = new ObjectManager(Product::class);

        return new JsonResponse($object->getData());
    }
}