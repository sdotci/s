<?php

declare(strict_types=1);

namespace S\Cli\Commands;

use S\Foundation\Cli\Command;

class Hello extends Command
{
    public function __construct()
    {
        parent::__construct('hello', '[name]');
    }
}
