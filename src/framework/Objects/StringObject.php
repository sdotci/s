<?php

declare(strict_types=1);

namespace S\Objects;

use S\Foundation\Concerns\AsString;
use S\Foundation\Contracts\IsString;

class StringObject implements IsString
{
    use AsString;

    public function __construct(protected string $value) {}

    public function get(): string
    {
        return $this->value;
    }
}
