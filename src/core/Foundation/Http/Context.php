<?php

declare(strict_types=1);

namespace S\Foundation\Http;

use S\Foundation\Context as BaseContext;

class Context extends BaseContext
{
    public function __construct(?array $data = null)
    {
        parent::__construct(new ServerInput($data));
    }

    public static function global(): self
    {
        return new self($_SERVER);
    }
}
