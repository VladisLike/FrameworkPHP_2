<?php

namespace Application\Controller;

use Framework\Common\AbstractController;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;

class HomeController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $name = $request->getParams()['name'] ?? 'Guest';
        return new Response("<h1>Home Page ($name)<h1/>");
    }
}