<?php

declare(strict_types=1);

namespace S\Objects;

use S\Foundation\Concerns\AsBool;
use S\Foundation\Contracts\IsBool;

class BoolObject implements IsBool
{
    use AsBool;

    public function __construct(protected bool $value) {}

    public function get(): bool
    {
        return $this->value;
    }
}
