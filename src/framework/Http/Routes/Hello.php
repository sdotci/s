<?php

declare(strict_types=1);

namespace S\Http\Routes;

use S\Foundation\Http\Route;

class Hello extends Route
{
    public function __construct()
    {
        parent::__construct('hello', ':name?', ['GET']);
    }
}
