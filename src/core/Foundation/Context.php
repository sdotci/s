<?php

declare(strict_types=1);

namespace S\Foundation;

abstract class Context
{
    /**
     * @var mixed[]
     */
    protected array $attributes = [];

    public function __construct(protected Input $input) {}

    abstract public static function global(): self;

    public function getInput(): Input
    {
        return $this->input;
    }

    public function withInput(Input $input): static
    {
        $this->input = $input;

        return $this;
    }

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
