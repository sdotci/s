<?php

declare(strict_types=1);

namespace S\Foundation\Http;

use S\Foundation\Application as BaseApplication;
use S\Foundation\Input;

class Application extends BaseApplication
{
    protected Input $input;

    protected array $routes = [];

    public function __construct(Context $context)
    {
        parent::__construct($context);
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
        $input = $this->context->getInput();

        $method = $input->get('REQUEST_METHOD', 'GET');
        $uri = $input->get('REQUEST_URI', '/');

        $startLine = "{$method} {$uri}";

        foreach ($this->routes as $route) {
            if ($route->match($startLine)) {
                $route->resolve()->send();

                return;
            }
        }
    }
}
