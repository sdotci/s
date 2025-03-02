<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

interface Statement
{
    public static function parse(mixed $value): self;
}
