<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\ResponseInterface;

class AllPostController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new PostRepository();
        /** @var Post[] $cars */
        $posts = $repository->findAll();
        dump($posts);
        exit();

        return new Response($posts);
    }
}