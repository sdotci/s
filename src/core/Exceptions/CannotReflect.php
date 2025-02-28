<?php

declare(strict_types=1);

namespace S\Exceptions;

use Spl\Exceptions\ExceptionInterface;
use Spl\Exceptions\ExceptionTrait;

final class CannotReflect extends \ReflectionException implements ExceptionInterface
{
    use ExceptionTrait;
}
