<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Application\Repository\CarRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;

class AllCarController extends AbstractController
{
    private JsonSerializer $serializer;
    private CarRepository $repository;

    public function __construct(JsonSerializer $serializer, CarRepository $repository)
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        /** @var Car[] $cars */
        $cars = $this->repository->findAll();

        return new JsonResponse($cars);
    }

    public function showOne(RequestInterface $request, Car $car): ResponseInterface
    {
        return new JsonResponse($car);
    }
}