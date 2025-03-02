<?php

declare(strict_types=1);

namespace S\Objects;

use S\Foundation\Concerns\AsInt;
use S\Foundation\Contracts\IsInt;

class IntObject implements IsInt
{
    use AsInt;

    public function __construct(protected int $value) {}

    public function get(): int
    {
        return $this->value;
    }
}
