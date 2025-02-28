<?php

declare(strict_types=1);

namespace S\Contracts;

use S\Exceptions\IsNotFound;

interface IsResolvable
{
    /**
     * Allows you to call actions
     *
     * @param  array<mixed>  $args
     *
     * @throws IsNotFound When action is not defined
     */
    public function __call(string $name, array $args = []): mixed;

    /**
     * Allows to call static actions
     *
     * @param  array<mixed>  $args
     *
     * @throws IsNotFound When action is not defined
     */
    public static function __callStatic(string $name, array $args = []): mixed;
}
