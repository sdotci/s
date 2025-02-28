<?php

declare(strict_types=1);

namespace S\Config;

interface SettingsArrayInterface extends \Countable, \IteratorAggregate, SettingsOffsetsInterface
{
    public function count(): int;

    public function getIterator(): \Traversable;
}
