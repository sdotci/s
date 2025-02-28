<?php

declare(strict_types=1);

namespace S\Foundation\Http;

class Server
{
    /** @var array<string, string> */
    protected array $input = [];

    protected array $routes = [];

    public function __construct(?array $input = null)
    {
        $this->input = $input ?? $_SERVER;
    }

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

    public function run(): void
    {
        $input = $this->input;

        $method = $input['REQUEST_METHOD'] ?? 'GET';
        $uri = $input['REQUEST_URI'] ?? '/';

        $startLine = "{$method} $uri";

        foreach ($this->routes as $route) {
            if ($route->match($startLine)) {
                $route->resolve()->send();

                return;
            }
        }
    }
}
