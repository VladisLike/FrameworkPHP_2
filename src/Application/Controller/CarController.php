<?php

namespace Application\Controller;

use Application\Model\Car;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\RepositoryInterface;

class CarController extends AbstractController
{
    private JsonSerializer $serializer;
    private RepositoryInterface $repository;

    public function __construct(JsonSerializer $serializer, RepositoryInterface $repository)
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        /** @var Car[] $cars */
        $cars = $this->repository->findAll();

        return new JsonResponse($this->serializer->serialize($cars, [
            'groups' => ['car:read']
        ]));
    }

    public function showOne(RequestInterface $request, Car $car): ResponseInterface
    {
        return new JsonResponse($this->serializer->serialize([$car], [
            'groups' => ['car:read']
        ]));
    }
}