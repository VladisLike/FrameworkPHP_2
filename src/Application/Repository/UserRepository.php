<?php

namespace Application\Repository;

use Application\Model\User;
use Framework\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{

    function getModel(): string
    {
        return User::class;
    }
}