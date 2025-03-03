<?php

declare(strict_types=1);

namespace S\Http;

use S\Foundation\Action;

class Route extends Action
{
    public function getPattern(): string
    {
        $pattern = $this->getSignature();
        $pattern = preg_replace('/\s+/', ' ', $pattern);
        $pattern = str_replace(['/', '{', '}', ' '], ['\\/', '(?P<', '>.*)', '\s+'], $pattern);

        return $pattern;
    }
}
