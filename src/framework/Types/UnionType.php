<?php

declare(strict_types=1);

namespace S\Types;

use S\Concerns\AsUnionType;
use S\Contracts\IsType;
use S\Contracts\IsUnionType;

final class UnionType extends Type implements IsUnionType
{
    use AsUnionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
