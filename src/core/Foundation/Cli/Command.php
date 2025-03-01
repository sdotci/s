<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Action;

class Command extends Action
{
    public function getPattern(): string
    {
        $pattern = str_replace(['<', '>', '[', ']'], ['(?P<', '>.*)', '(?P<', '>.*)?'], $this->getSignature());

        return $pattern;
    }
}
