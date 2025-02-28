<?php

declare(strict_types=1);

namespace S\Bases;

use S\Contracts\IsParameter;
use S\Contracts\IsType;
use S\Enums\TypeName;

abstract class BaseParameter implements IsParameter
{
    public function __construct(string|TypeName|IsType $type, string $name, mixed $value)
    {
        $this->setType($type)->setName($name)->setValue($value);
    }
}
