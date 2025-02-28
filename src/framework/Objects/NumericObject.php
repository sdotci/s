<?php

declare(strict_types=1);

namespace S\Objects;

use S\Concerns\AsNumeric;
use S\Contracts\IsNumeric;

class NumericObject implements IsNumeric
{
    use AsNumeric;

    public function __construct(protected int|float|string $value) {}

    public function get(): int|float|string
    {
        return $this->value;
    }
}
