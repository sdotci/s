<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Contracts\IsParameter;
use S\Foundation\Contracts\IsType;
use S\Foundation\Enums\TypeName;

abstract class Parameter implements IsParameter
{
    public function __construct(string|TypeName|IsType $type, string $name, mixed $value)
    {
        $this->setType($type)->setName($name)->setValue($value);
    }
}
