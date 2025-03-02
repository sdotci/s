<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

interface IsScalar extends \Stringable, IsMixed
{
    public function __invoke(mixed $value = null): bool|int|float|string;

    public function get(): bool|int|float|string;
}
