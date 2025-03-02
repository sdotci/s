<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

class Declaration
{
    public function __construct(readonly Type $type, readonly string $name) {}
}
