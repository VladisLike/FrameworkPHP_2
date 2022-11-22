<?php

namespace Framework\Routing\Exception;

use Framework\Http\Request;

class NotMatchedException extends \LogicException
{
    private Request $request;

    public function __construct(Request $request)
    {
        parent::__construct('Matches not found');
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

}