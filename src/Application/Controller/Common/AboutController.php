<?php

namespace Application\Controller\Common;

use Framework\Common\AbstractController;
use Framework\Http\Request\Request;
use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\Response;
use Framework\Http\Response\ResponseInterface;

class AboutController extends AbstractController
{

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        return new Response("<h1>About Page<h1/>");
    }
}