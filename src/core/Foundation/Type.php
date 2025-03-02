<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Contracts\IsType;

abstract class Type implements IsType
{
    public function __construct(bool $nullable = false)
    {
        $this->nullable = $nullable;
    }
}
