<?php

declare(strict_types=1);

namespace S\Foundation;

abstract class Action
{
    public function __construct(protected string $name) {}
}
