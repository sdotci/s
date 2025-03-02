<?php

declare(strict_types=1);

namespace S\Objects;

use S\Foundation\Concerns\AsMixed;
use S\Foundation\Contracts\IsMixed;

class MixedObject implements IsMixed
{
    use AsMixed;

    public function __construct(protected mixed $value) {}

    public function get(): mixed
    {
        return $this->value;
    }
}
