<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use BadMethodCallException as BaseException;

class BadMethodCallException extends BaseException implements ExceptionInterface
{
    use ExceptionTrait;
}
