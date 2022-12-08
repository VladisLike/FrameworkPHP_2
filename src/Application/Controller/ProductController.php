<?php

namespace Application\Controller;

use Application\Model\Product;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\RepositoryInterface;

class ProductController extends AbstractController
{
    private JsonSerializer $serializer;
    private RepositoryInterface $repository;

//    private EventDispatcher $eventDispatcher;

    public function __construct(
        JsonSerializer      $serializer,
        RepositoryInterface $repository
//        EventDispatcher     $dispatcher
    )
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
//        $this->eventDispatcher = $dispatcher;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        /** @var Product[] $cars */
        $products = $this->repository->findAll();
//        /** @var Car $car */
//        $car = $this->carRepository->find(1);
//        $this->eventDispatcher->dispatch(new NewCarEvent($car), NewCarEvent::NAME);
//        $this->eventDispatcher->dispatch(new SeveralCarEvent($this->carRepository->findAll()), SeveralCarEvent::NAME);

        return new JsonResponse($this->serializer->serialize($products, [
            'groups' => ['product:read']
        ]));
    }

    public function showOne(RequestInterface $request, Product $product): ResponseInterface
    {
        return new JsonResponse($this->serializer->serialize([$product], [
            'groups' => ['product:read']
        ]));
    }
}