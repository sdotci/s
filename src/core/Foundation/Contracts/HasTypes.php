<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

use S\Foundation\Enums\BuiltinType;

interface HasTypes
{
    /**
     * @return array<IsType>
     */
    public function getTypes(): array;

    public function hasType(string|BuiltinType|IsType $type): bool;
}
