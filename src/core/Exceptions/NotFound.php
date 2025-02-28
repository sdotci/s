<?php

declare(strict_types=1);

namespace S\Exceptions;

use Spl\Exceptions\InvalidArgumentException;

final class NotFound extends InvalidArgumentException implements IsNotFound {}
