<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Contracts\IsArgument;

abstract class Argument implements IsArgument
{
    public function __construct(int $index, mixed $value)
    {
        $this->setIndex($index)->setValue($value);
    }
}
