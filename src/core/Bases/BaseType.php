<?php

declare(strict_types=1);

namespace S\Bases;

use S\Contracts\IsType;

abstract class BaseType implements IsType
{
    public function __construct(bool $nullable = false)
    {
        $this->nullable = $nullable;
    }
}
