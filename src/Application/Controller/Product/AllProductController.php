<?php

namespace Application\Controller\Product;

use Application\Event\NewCarEvent;
use Application\Event\SeveralCarEvent;
use Application\Model\Car;
use Application\Model\Product;
use Application\Repository\CarRepository;
use Application\Repository\ProductRepository;
use Framework\Common\AbstractController;
use Framework\EventDispatcher\EventDispatcher;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;

class AllProductController extends AbstractController
{
    private JsonSerializer $serializer;
    private ProductRepository $repository;
    private CarRepository $carRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(
        JsonSerializer $serializer,
        ProductRepository $repository,
        CarRepository $carRepository,
        EventDispatcher $dispatcher
    )
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
        $this->carRepository = $carRepository;
        $this->eventDispatcher = $dispatcher;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        /** @var Product[] $cars */
        $products = $this->repository->findAll();
        /** @var Car $car */
        $car = $this->carRepository->find(1);
        $this->eventDispatcher->dispatch(new NewCarEvent($car), NewCarEvent::NAME);
        $this->eventDispatcher->dispatch(new SeveralCarEvent($this->carRepository->findAll()), SeveralCarEvent::NAME);

        return new JsonResponse($this->serializer->serialize($products, [
            'groups' => ['product:read']
        ]));
    }
}