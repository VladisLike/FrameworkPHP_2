<?php

namespace Framework\Routing;

use Framework\Http\Request\RequestInterface;
use Framework\Routing\Router\Result;

class Route implements RouteInterface
{
    private string $name;
    private string $path;

    /**
     * @var mixed
     */
    private $handler;
    private array $methods;
    private array $tokens;

    public function __construct(string $name, string $path, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }

    public function match(RequestInterface $request): ?Result
    {
        if (empty($this->methods)) {
            return null;
        }

        $pattern = preg_replace_callback('~\{([^}]+)}~', function ($matches) {
            $argument = $matches[1];
            $replace = $this->tokens[$argument] ?? '[^}]+';
            return '(?P<' . $argument . '>' . $replace . ')';
        }, $this->path);

        $path = $request->getUriPath();

        if (!preg_match('~^' . $pattern . '$~i', $path, $matches)) {
            return null;
        }

        return new Result(
            $this->name,
            $this->handler,
            array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
        );

    }

}