<?php

declare(strict_types=1);

namespace S\Cli;

use S\Foundation\Route;
use S\Foundation\Router as BaseRouter;

class Router extends BaseRouter
{
    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function on(string $signature, array|string|object|callable $handler, ?string $name = null, ?string $description = null): Route
    {
        $signature = preg_replace('/\s+/', ' ', $signature);
        $signature = str_replace(['<', '>', ' [', '[', ']', ' '], ['(?P<', '>.*)', '\s*(?P<', '(?P<', '>.*)?', '\s+'], $signature);

        return parent::on($signature, $handler, $name, $description);
    }
}
