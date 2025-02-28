<?php

declare(strict_types=1);

namespace S\Concretes;

class Error extends \Exception
{
    public const INVALID_TYPE = 0x00001;

    public const INVALID_KEY = 0x00002;

    public const INVALID_VALUE = 0x00003;
}
