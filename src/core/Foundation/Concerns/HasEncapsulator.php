<?php

declare(strict_types=1);

namespace S\Foundation\Concerns;

trait HasEncapsulator
{
    use HasAccessor;
    use HasModifier;
    use HasResolver;
}
