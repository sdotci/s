<?php

declare(strict_types=1);

namespace S\Http;

use S\Foundation\Action;

class Route extends Action
{
    public function getPattern(): string
    {
        $pattern = str_replace(['/', '{', '}'], ['\\/', '(?P<', '>.*)'], $this->getSignature());

        return $pattern;
    }
}
