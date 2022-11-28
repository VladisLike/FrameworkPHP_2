<?php

namespace Application\Controller\User;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\ResponseInterface;

class AllUserController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new UserRepository();
        /** @var User[] $cars */
        $users = $repository->findAll();
        dump($users);
        exit();

        return new Response($users);
    }
}