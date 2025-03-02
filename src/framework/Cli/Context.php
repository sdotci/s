<?php

declare(strict_types=1);

namespace S\Cli;

use S\Foundation\Context as BaseContext;

class Context extends BaseContext
{
    public function __construct(?int $argc = null, ?array $argv = null)
    {
        parent::__construct(new ArgsInput($argc, $argv));
    }

    public static function global(): self
    {
        return new self($_SERVER['argc'], $_SERVER['argv']);
    }
}
