<?php

declare(strict_types=1);

namespace S\Types;

use S\Foundation\Concerns\AsType;
use S\Foundation\Type as BaseType;

abstract class Type extends BaseType
{
    use AsType;
}
