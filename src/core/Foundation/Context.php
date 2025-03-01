<?php

declare(strict_types=1);

namespace S\Foundation;

abstract class Context
{
    public function __construct(protected Input $input) {}

    abstract public static function global(): self;

    public function getInput(): Input
    {
        return $this->input;
    }
}
