<?php

declare(strict_types=1);

namespace S\Foundation;

abstract class Input
{
    /**
     * @param  array<int|string, mixed>  $data
     */
    public function __construct(protected array $data) {}

    /**
     * @return array<int|string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function get(int|string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function has(int|string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function set(int|string $key, mixed $value): static
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function remove(int|string $key): static
    {
        unset($this->data[$key]);

        return $this;
    }
}
