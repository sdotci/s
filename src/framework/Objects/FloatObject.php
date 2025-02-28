<?php

declare(strict_types=1);

namespace S\Objects;

use S\Concerns\AsFloat;
use S\Contracts\IsFloat;

class FloatObject implements IsFloat
{
    use AsFloat;

    public function __construct(protected float $value) {}

    public function get(): float
    {
        return $this->value;
    }
}
