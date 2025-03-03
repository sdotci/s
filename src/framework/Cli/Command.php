<?php

declare(strict_types=1);

namespace S\Cli;

use S\Foundation\Action;

class Command extends Action
{
    public function getPattern(): string
    {
        $pattern = $this->getSignature();
        $pattern = preg_replace('/\s+/', ' ', $pattern);
        $pattern = str_replace(['<', '>', ' [', '[', ']', ' '], ['(?P<', '>.*)', '\s*(?P<', '(?P<', '>.*)?', '\s+'], $pattern);

        return $pattern;
    }
}
