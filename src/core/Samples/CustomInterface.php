<?php

declare(strict_types=1);

namespace S\Samples;

use S\Foundation\Contracts\IsEncapsulated;

interface CustomInterface extends IsEncapsulated
{
    public function getName(): string;

    public function setName(string $name): static;
}
