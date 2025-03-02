<?php

declare(strict_types=1);

namespace S\Types;

use S\Foundation\Concerns\AsNamedType;
use S\Foundation\Contracts\IsNamedType;
use S\Foundation\Enums\BuiltinType;

final class NamedType extends Type implements IsNamedType
{
    use AsNamedType;

    public function __construct(string|BuiltinType $name, bool $nullable = false)
    {
        parent::__construct($nullable);

        if ($name instanceof BuiltinType) {
            $name = $name->value;
        }

        $this->name = $name;
    }
}
