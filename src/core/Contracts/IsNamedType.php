<?php

declare(strict_types=1);

namespace S\Contracts;

use S\Enums\BuiltinType;

interface IsNamedType extends IsNamed, IsType
{
    public function isBuiltin(): bool;

    public function in(string|BuiltinType|IsType ...$types): bool;
}
