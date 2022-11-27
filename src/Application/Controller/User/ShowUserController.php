<?php

namespace Application\Controller\User;

use Application\Model\User;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\ObjectManager;

class ShowUserController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $object = new ObjectManager(User::class);

        return new JsonResponse($object->getData());
    }
}