<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

use S\Foundation\Concerns\AsNamed;
use S\Foundation\Contracts\IsNamed;

class Alias implements IsNamed
{
    use AsNamed;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
