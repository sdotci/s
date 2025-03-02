<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

use S\Foundation\Enums\BuiltinType;

interface HasType
{
    public function setType(IsType $type): static;

    public function getType(): IsType;

    public function typeIs(string|BuiltinType|IsType $type): bool;
}
