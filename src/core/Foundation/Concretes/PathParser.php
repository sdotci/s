<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

interface PathParser
{
    /**
     * Parse the parser path
     *
     * @return namespace\PathParsed
     */
    public function parse(): PathParsed;
}
