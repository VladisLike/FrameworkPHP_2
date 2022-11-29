<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;

class IndexPostController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new PostRepository();
        /** @var Post $car */
        $post = $repository->find($id);

        return new JsonResponse($post);
    }
}