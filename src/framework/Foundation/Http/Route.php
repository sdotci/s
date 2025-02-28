<?php

declare(strict_types=1);

namespace S\Foundation\Http;

use S\Foundation\Action;

class Route extends Action
{
    public function __construct(string $name, protected string $path, protected array $methods = [])
    {
        parent::__construct($name);
    }
}
