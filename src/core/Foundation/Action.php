<?php

declare(strict_types=1);

namespace S\Foundation;

abstract class Action
{
    protected array $matches = [];

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function __construct(protected string $signature, protected mixed $handler, protected ?string $name = null, protected ?string $description = null) {}

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

    abstract public function getPattern(): string;

    /**
     * @return array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed
     */
    public function getHandler(): array|string|object|callable
    {
        return $this->handler;
    }

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function setHandler(array|string|object|callable $handler): static
    {
        $this->handler = $handler;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function match(string $subject): bool
    {
        $pattern = $this->getPattern();

        return preg_match("/$pattern/", $subject, $this->matches) === 1;
    }

    public function getMatches(): array
    {
        return $this->matches;
    }

    public function resolve(mixed ...$args): Result
    {
        $result = ($this->handler)(...$args);

        return new Result($result);
    }
}
