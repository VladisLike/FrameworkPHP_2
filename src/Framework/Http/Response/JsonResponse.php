<?php

namespace Framework\Http\Response;

use InvalidArgumentException;

class JsonResponse extends Response
{
    use InjectContentTypeTrait;

    const DEFAULT_JSON_FLAGS = 79;
    private int $encodingOptions;

    public function __construct($data, int $status = 200, array $headers = [], int $encodingOptions = self::DEFAULT_JSON_FLAGS)
    {
        $this->encodingOptions = $encodingOptions;
        $bodyJson = json_encode($data, $encodingOptions);
        $headers = $this->injectContentType('application/json', $headers);
        
        parent::__construct(
            $bodyJson,
            $status,
            $headers
        );
    }


}