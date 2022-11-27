<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\ObjectManager;

class ShowPostController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $object = new ObjectManager(Post::class);

        return new JsonResponse($object->getData());
    }
}