<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Application\Repository\CarRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;

class AllCarController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new CarRepository();
        /** @var Car[] $cars */
        $cars = $repository->findAll();

        return new JsonResponse($cars);
    }
}