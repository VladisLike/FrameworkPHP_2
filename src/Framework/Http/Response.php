<?php

namespace Framework\Http;

use http\Encoding\Stream;

class Response
{
    private $phrases = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        // SERVER ERROR
        500 => 'Internal Server Error',
    ];

    private array $headers = [];

    private string $reasonPhrase;

    private int $statusCode;

    private string $body;


    public function __construct(string $body = '', int $status = 200, array $headers = [])
    {
        $this->setStatusCode($status);
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setStatusCode(int $code, $reasonPhrase = ''): void
    {
        if ($reasonPhrase === '' && isset($this->phrases[$code])) {
            $reasonPhrase = $this->phrases[$code];
        }

        $this->reasonPhrase = $reasonPhrase;
        $this->statusCode = $code;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    public function getBody(): string
    {
        return $this->body;
    }

}