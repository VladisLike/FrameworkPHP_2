<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Application\Repository\CarRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataFilePHP;

class IndexCarController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new CarRepository(new DataFilePHP());
        /** @var Car $car */
        $car = $repository->find($id);

        return $car === null ? new Response('<h1>Not Found!</h1>') : new JsonResponse($car);
    }
}