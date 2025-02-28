<?php

declare(strict_types=1);

namespace S\Concretes;

interface Output
{
    public function write(string $text, ?int $length = null): int|false;

    public function writeLine(string $line, ?int $length = null): int|false;

    public function writeChar(string $char): int|false;

    public function print(string $format, ...$vals): int;
}
