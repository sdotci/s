<?php

declare(strict_types=1);

namespace S\Objects;

use S\Concerns\AsNumber;
use S\Contracts\IsNumber;

class NumberObject implements IsNumber
{
    use AsNumber;

    public function __construct(protected int|float $value) {}

    public function get(): int|float
    {
        return $this->value;
    }
}
