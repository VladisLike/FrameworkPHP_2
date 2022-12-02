<?php

namespace Framework\Helpers;

final class SyntaxHelper
{
    public static function camelToSnake(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

}