<?php

declare(strict_types=1);

namespace S\Foundation\Concerns;

trait AsType
{
    protected bool $nullable = false;

    public function allowsNull(): bool
    {
        return $this->nullable;
    }
}
