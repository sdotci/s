<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

interface UrlParser
{
    /**
     * Parse the parser url
     *
     * @return namespace\UrlParsed
     */
    public function parse(): UrlParsed;
}
