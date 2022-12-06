<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;
use Framework\Repository\DataResource\DataFilePHP;

class IndexPostController extends AbstractController
{
    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $repository = new PostRepository(new DataFilePHP());
        /** @var Post $car */
        $post = $repository->find($id);

        return $post === null ? new Response('<h1>Not Found!</h1>') : new JsonResponse($post);
    }
}