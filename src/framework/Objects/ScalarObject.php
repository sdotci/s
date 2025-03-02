<?php

declare(strict_types=1);

namespace S\Objects;

use S\Foundation\Concerns\AsScalar;
use S\Foundation\Contracts\IsScalar;

class ScalarObject implements IsScalar
{
    use AsScalar;

    public function __construct(protected bool|int|float|string $value) {}

    public function get(): bool|int|float|string
    {
        return $this->value;
    }
}
