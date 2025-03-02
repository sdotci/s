<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Contracts\IsOption;

abstract class Option implements IsOption
{
    public function __construct(int|string $key, mixed $value)
    {
        $this->setKey($key)->setValue($value);
    }
}
