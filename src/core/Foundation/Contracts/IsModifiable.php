<?php

declare(strict_types=1);

namespace S\Foundation\Contracts;

use S\Exceptions\IsNotFound;

interface IsModifiable
{
    /**
     * Allows you to modify a property
     *
     * @throws IsNotFound When property is not defined
     */
    public function __set(string $name, mixed $value): void;

    /**
     * Allows you to delete a property
     */
    public function __unset(string $name): void;
}
