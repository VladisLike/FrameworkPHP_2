<?php

namespace Application\Controller\Post;

use Application\Model\Post;
use Application\Repository\PostRepository;
use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\ResponseInterface;
use Framework\Http\Response\Serializer\JsonSerializer;
use Framework\Repository\DataResource\DataFilePHP;

class AllPostController extends AbstractController
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
            'groups' => ['user:read']
        ]));
    }
}