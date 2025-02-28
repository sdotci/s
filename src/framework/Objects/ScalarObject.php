<?php

declare(strict_types=1);

namespace S\Objects;

use S\Concerns\AsScalar;
use S\Contracts\IsScalar;

class ScalarObject implements IsScalar
{
    use AsScalar;

    public function __construct(protected bool|int|float|string $value) {}

    public function get(): bool|int|float|string
    {
        return $this->value;
    }
}
