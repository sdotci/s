<?php

declare(strict_types=1);

namespace S\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Spl\Exceptions\ExceptionInterface;

interface IsNotFound extends ExceptionInterface, NotFoundExceptionInterface {}
