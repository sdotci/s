<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

class Scope
{
    public function __construct(readonly Container $container, readonly ?Scope $parent = null) {}
}
