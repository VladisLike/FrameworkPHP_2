<?php

namespace Framework\Routing\Exception;

use Framework\Http\Request\Request;
use Framework\Http\Request\RequestInterface;

class NotMatchedException extends \LogicException
{
    private Request $request;

    public function __construct(RequestInterface $request)
    {
        parent::__construct('Matches not found');
        $this->request = $request;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

}