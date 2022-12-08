<?php

namespace Application\Controller;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\DataResource\DataFilePHP;

class PostController extends AbstractController
{
    private JsonSerializer $serializer;

    public function __construct(JsonSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $repository = new PostRepository(new DataFilePHP());
        /** @var Post[] $cars */
        $posts = $repository->findAll();

        return new JsonResponse($this->serializer->serialize($posts, [
            'groups' => ['post:read']
        ]));
    }

    public function showOne(RequestInterface $request, Post $post): ResponseInterface
    {
        return new JsonResponse($this->serializer->serialize([$post], [
            'groups' => ['post:read']
        ]));
    }
}