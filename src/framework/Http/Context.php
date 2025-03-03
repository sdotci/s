<?php

declare(strict_types=1);

namespace S\Http;

use S\Foundation\Context as BaseContext;

class Context extends BaseContext
{
    public function __construct(?array $data = null)
    {
        parent::__construct(new ServerInput($data));
        $this->set('router', Router::class);
    }

    public static function global(): self
    {
        return new self($_SERVER);
    }

    public function getSubject(): string
    {
        $input = $this->getInput();

        $method = $input->get('REQUEST_METHOD', 'GET');
        $uri = $input->get('REQUEST_URI', '/');

        return "{$method} {$uri}";
    }
}
