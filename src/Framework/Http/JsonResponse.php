<?php

namespace Framework\Http;

class JsonResponse extends Response
{
    use InjectContentTypeTrait;

    public function __construct($html, int $status = 200, array $headers = [])
    {
        parent::__construct(
            json_encode($html),
            $status,
            $this->injectContentType('text/html; charset=utf-8', $headers)
        );
    }


}