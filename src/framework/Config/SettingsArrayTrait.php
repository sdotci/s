<?php

declare(strict_types=1);

namespace S\Config;

trait SettingsArrayTrait
{
    use SettingsOffsetsTrait;

    public function count(): int
    {
        return count($this->options);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->options);
    }
}
