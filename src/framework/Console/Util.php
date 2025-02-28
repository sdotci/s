<?php

declare(strict_types=1);

namespace S\Console;

class Util
{
    private static function normalizeMethod(string $method): string
    {
        return lcfirst(str_replace('_', '', ucwords((string) $method, '_')));
    }
}
