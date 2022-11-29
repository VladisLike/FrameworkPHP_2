<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Application\Repository\CarRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;

class IndexCarController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new CarRepository();
        /** @var Car $car */
        $car = $repository->find($id);

        return new JsonResponse($car);
    }
}