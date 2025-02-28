<?php

declare(strict_types=1);

namespace S\Types;

use S\Bases\BaseType;
use S\Concerns\AsType;

abstract class Type extends BaseType
{
    use AsType;
}
