<?php

declare(strict_types=1);

namespace S\Foundation\Http;

class Router
{
    protected array $routes = [];

    public function __construct(protected string $base = '', protected string $path = '') {}

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

    public function run(string $request): void
    {
        foreach ($this->routes as $route) {
            $signature = str_replace('/', '\\/', $route->getSignature());
            $pattern = "/{$signature}/";
            if (preg_match($pattern, $request, $matches)) {
                $handler = $route->getHandler();
                $result = $handler(...$matches);

                if (is_string($result)) {
                    echo $result;
                }
            }
        }
    }
}
