<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Input;

class ArgsInput extends Input
{
    protected int $count = 0;

    public function __construct(?int $count, ?array $values)
    {
        $values ??= $_SERVER['argv'] ?? [];
        $count ??= $_SERVER['argc'] ?? count($values);

        if ($count !== count($values)) {
            exit_error('Wrong arguments count');
        }

        if ($count < 1) {
            exit_error('No argument given');
        }

        $this->count = $count;
        parent::__construct($values);
    }
}
