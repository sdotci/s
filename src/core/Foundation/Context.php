<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Concretes\Container;

abstract class Context extends Container
{
    /**
     * @var mixed[]
     */
    protected array $attributes = [];

    public function __construct(protected Input $input)
    {
        parent::__construct(compact('input'));
    }

    abstract public static function global(): self;

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function on(string $signature, array|string|object|callable $handler, ?string $name = null, ?string $description = null): Route
    {
        return $this->add(new Route($signature, $handler, $name, $description));
    }

    public function getInput(): Input
    {
        return $this->input;
    }

    public function withInput(Input $input): static
    {
        $this->input = $input;

        return $this;
    }

    abstract public function getSubject(): string;

    /**
     * @return mixed[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param  mixed[]  $attributes
     */
    public function withAttributes(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function setAttribute(string $key, mixed $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function getAttribute(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }
}
