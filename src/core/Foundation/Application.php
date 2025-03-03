<?php

declare(strict_types=1);

namespace S\Foundation;

class Application
{
    public function __construct(protected Context $context)
    {
        if (! $context->has('router')) {
            $context->set('router', Router::class);
        }
    }

    public function on(string $signature, array|string|object|callable $handler, ?string $name = null, ?string $description = null): Route
    {
        return $this->getRouter()->on($signature, $handler, $name, $description);
    }

    public function getRouter(): Router
    {
        /** @var Router $router */
        $router = $this->context->shared('router');

        return $router;
    }

    public function run(): int
    {
        $context = $this->context;

        if ($route = $this->getRouter()->get($context->getSubject())) {
            $context->withAttributes($route->getMatches());
            $route->resolve($context)->send();

            return 0;
        }

        return 1;
    }
}
