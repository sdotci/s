<?php

declare(strict_types=1);

namespace S\Http;

use S\Foundation\Input;

class ServerInput extends Input
{
    public function __construct(?array $data = [])
    {
        parent::__construct($data ?? $_SERVER);
    }
}
