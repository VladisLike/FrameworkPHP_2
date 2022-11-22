<?php

namespace Framework\Http;

trait InjectContentTypeTrait
{
    private function injectContentType(string $contentType, array $headers): array
    {
        $hasContentType = array_reduce(array_keys($headers), function ($carry, $item) {
            return $carry ?: (strtolower($item) === 'content-type');
        }, false);

        if (!$hasContentType) {
            $headers['content-type'] = [$contentType];
        }

        return $headers;
    }
}