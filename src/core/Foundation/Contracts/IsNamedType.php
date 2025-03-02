<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

use S\Foundation\Enums\BuiltinType;

interface IsNamedType extends IsNamed, IsType
{
    public function isBuiltin(): bool;

    public function in(string|BuiltinType|IsType ...$types): bool;
}
