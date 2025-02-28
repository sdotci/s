<?php

declare(strict_types=1);

namespace S\Foundation\Http;

use S\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo '<p>Welcome to S HTTP Application!</p>';
    }
}
