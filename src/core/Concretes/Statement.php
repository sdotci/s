<?php

declare(strict_types=1);

namespace S\Concretes;

interface Statement
{
    public static function parse(mixed $value): self;
}
