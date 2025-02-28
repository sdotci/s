<?php

declare(strict_types=1);

namespace S\Bases;

use S\Contracts\IsArgument;

abstract class BaseArgument implements IsArgument
{
    public function __construct(int $index, mixed $value)
    {
        $this->setIndex($index)->setValue($value);
    }
}
