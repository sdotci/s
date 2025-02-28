<?php

declare(strict_types=1);

namespace S\Concretes;

use S\Concerns\AsNamed;
use S\Contracts\IsNamed;

class Alias implements IsNamed
{
    use AsNamed;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
