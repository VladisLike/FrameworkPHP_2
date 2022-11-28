<?php

namespace Application\Repository;

use Application\Model\Post;
use Framework\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    function getModel(): string
    {
        return Post::class;
    }
}