<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;

class IndexPostController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new PostRepository();
        /** @var Post $car */
        $post = $repository->find($id);
        dump($post);
        exit();

        return new Response($post);
    }
}