<?php

declare(strict_types=1);

namespace S\Objects;

use S\Concerns\AsMixed;
use S\Contracts\IsMixed;

class MixedObject implements IsMixed
{
    use AsMixed;

    public function __construct(protected mixed $value) {}

    public function get(): mixed
    {
        return $this->value;
    }
}
