<?php

declare(strict_types=1);

namespace S\Types;

use S\Concerns\AsNamedType;
use S\Contracts\IsNamedType;
use S\Enums\BuiltinType;

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
