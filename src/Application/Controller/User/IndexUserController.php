<?php

namespace Application\Controller\User;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataFilePHP;

class IndexUserController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new UserRepository(new DataFilePHP());
        /** @var User $car */
        $user = $repository->find($id);

        return $user === null ? new Response('<h1>Not Found!</h1>') : new JsonResponse($user);
    }
}