<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Concretes\Container;

abstract class Application extends Container
{
    abstract public function run(): void;
}
