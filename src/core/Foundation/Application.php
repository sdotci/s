<?php

declare(strict_types=1);

namespace S\Foundation;

use S\Foundation\Concretes\Container;

abstract class Application extends Container
{
    public function __construct(protected Context $context) {}

    abstract public function run(): void;
}
