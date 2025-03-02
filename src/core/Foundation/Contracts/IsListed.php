<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

interface IsListed
{
    public function setList(array $list): static;

    public function addItem(string $item): static;

    public function getItem(int $index): mixed;

    public function getList(): array;
}
