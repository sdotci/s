<?php

declare(strict_types=1);

namespace S\Foundation\Concerns;

use S\Foundation\Contracts\IsType;
use S\Foundation\Enums\BuiltinType;

trait AsNamedType
{
    use AsNamed;
    use AsType;

    public function isBuiltin(): bool
    {
        return $this->in(BuiltinType::cases());
    }

    public function in(string|BuiltinType|IsType ...$types): bool
    {
        foreach ($types as $type) {
            if ($type->is($this)) {
                return true;
            }
        }

        return false;
    }

    public function is(string|BuiltinType|IsType $type): bool
    {
        if ($type instanceof Type) {
            return $this->nameIs($type::class);
        }

        if ($type instanceof BuiltinType) {
            return $this->nameIs($type->value);
        }

        return $this->nameIs($type);
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
