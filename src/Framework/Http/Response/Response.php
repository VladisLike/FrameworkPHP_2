<?php

namespace Framework\Http\Response;

class Response implements ResponseInterface
{
    private array $phrases = [
        100 => 'Continue',
        200 => 'OK',
        400 => 'Bad Request',
        404 => 'Not Found',
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