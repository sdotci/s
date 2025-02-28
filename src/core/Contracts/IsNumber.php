<?php

declare(strict_types=1);

namespace S\Contracts;

interface IsNumber extends IsNumeric
{
    public function __invoke(mixed $value = null): int|float;

    public function get(): int|float;
}
