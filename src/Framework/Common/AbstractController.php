<?php

namespace Framework\Common;

use Framework\Http\Request\RequestInterface;
use Framework\Http\Response\ResponseInterface;

abstract class AbstractController
{
    abstract public function __invoke(RequestInterface $request): ResponseInterface;

}