<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\ObjectManager;

class ShowCarController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $object = new ObjectManager(Car::class);

        return new JsonResponse($object->getData());
    }
}