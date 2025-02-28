<?php

declare(strict_types=1);

namespace S\Foundation\Http;

use S\Foundation\Action;

class Route extends Action
{
    public function getPattern(): string
    {
        $pattern = str_replace('/', '\\/', $this->getSignature());

        return $pattern;
    }
}
