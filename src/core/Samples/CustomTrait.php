<?php

declare(strict_types=1);

namespace S\Samples;

use S\Foundation\Concerns\HasEncapsulator;

trait CustomTrait
{
    use HasEncapsulator;

    protected string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
