<?php

namespace Application\Controller\User;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataFilePHP;

class AllUserController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new UserRepository(new DataFilePHP());
        /** @var User[] $cars */
        $users = $repository->findAll();

        return new JsonResponse($users);
    }
}