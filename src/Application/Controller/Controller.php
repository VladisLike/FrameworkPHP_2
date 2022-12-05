<?php

namespace Application\Controller;

use Application\Model\User;
use Application\Repository\UserRepository;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\DataResource\DataFilePHP;

class Controller
{
    private JsonSerializer $serializer;

    public function __construct(JsonSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function showAll(): array
    {
        $repository = new UserRepository(new DataFilePHP());
        /** @var User[] $cars */
        $users = $repository->findAll();

        // [{'name': 'Pavel', 'email': 'pavel.laikov98@gmail.com'}]
        return $this->serializer->serialize($users, [
            'groups' => ['user:read']
        ]);
    }

}