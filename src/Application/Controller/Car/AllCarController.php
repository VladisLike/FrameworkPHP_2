<?php

namespace Application\Controller\Car;

use Application\Model\Car;
use Application\Repository\CarRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;

class AllCarController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new CarRepository();
        /** @var Car[] $cars */
        $cars = $repository->findAll();
        dump($cars);
        exit();

        return new Response($cars);
    }
}