<?php

namespace Application\Controller\User;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\DataResource\DataFilePHP;

class AllUserController extends AbstractController
{
    private JsonSerializer $serializer;

    public function __construct(JsonSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new UserRepository(new DataFilePHP());
        /** @var User[] $cars */
        $users = $repository->findAll();

        return new JsonResponse($this->serializer->serialize($users, [
            'groups' => ['user:read']
        ]));
    }
}