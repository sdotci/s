<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Action;

class Command extends Action
{
    public function __construct(string $name, protected string $signature = '', protected string $description = '')
    {
        parent::__construct($name);
    }
}
