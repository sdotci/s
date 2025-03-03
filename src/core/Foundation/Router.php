<?php

declare(strict_types=1);

namespace S\Foundation;

class Router
{
    protected array $routes = [];

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function on(string $signature, array|string|object|callable $handler, ?string $name = null, ?string $description = null): Route
    {
        return $this->add(new Route($signature, $handler, $name, $description));
    }

    public function add(Route $route): Route
    {
        $this->routes[] = $route;

        return $route;
    }

    public function get(string $subject): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->match($subject)) {
                return $route;
            }
        }

        return null;
    }
}
