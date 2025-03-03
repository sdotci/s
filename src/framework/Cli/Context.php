<?php

declare(strict_types=1);

namespace S\Cli;

use S\Foundation\Context as BaseContext;

class Context extends BaseContext
{
    public function __construct(?int $argc = null, ?array $argv = null)
    {
        parent::__construct(new ArgsInput($argc, $argv));
        $this->set('router', Router::class);
    }

    public static function global(): self
    {
        return new self($_SERVER['argc'], $_SERVER['argv']);
    }

    public function getSubject(): string
    {
        $input = $this->getInput();

        $arg0 = $input->get(0);

        $binFile = realpath($arg0);
        $input->remove(0);

        return implode(' ', $input->getData());
    }
}
