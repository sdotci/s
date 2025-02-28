<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo 'Welcome to S CLI Application!'.PHP_EOL;
    }
}
