<?php

declare(strict_types=1);

namespace S\Types;

use S\Concerns\AsIntersectionType;
use S\Contracts\IsIntersectionType;
use S\Contracts\IsType;

final class IntersectionType extends Type implements IsIntersectionType
{
    use AsIntersectionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
