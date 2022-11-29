<?php

namespace Application\Controller\User;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;

class IndexUserController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new UserRepository();
        /** @var User $car */
        $user = $repository->find($id);

        return new JsonResponse($user);
    }
}