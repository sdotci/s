<?php

declare(strict_types=1);

namespace S\Types;

use S\Foundation\Concerns\AsUnionType;
use S\Foundation\Contracts\IsType;
use S\Foundation\Contracts\IsUnionType;

final class UnionType extends Type implements IsUnionType
{
    use AsUnionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
