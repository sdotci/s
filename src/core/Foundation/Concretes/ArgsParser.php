<?php

declare(strict_types=1);

namespace S\Foundation\Concretes;

class ArgsParser
{
    private array $options = [];

    private array $arguments = [];

    private bool $stopParsingOptions = false;

    public function __construct(protected array $args)
    {
        $this->parse();
    }

    private function parse(): void
    {
        while ($this->args) {
            $arg = array_shift($this->args);

            if ($this->stopParsingOptions) {
                $this->arguments[] = $arg;

                continue;
            }

            if ($arg === '--') {
                $this->stopParsingOptions = true;

                continue;
            }

            if (str_starts_with((string) $arg, '--')) {
                [$key, $value] = explode('=', substr((string) $arg, 2), 2) + [null, true];
                $this->options[$key] = $value;
            } elseif (str_starts_with((string) $arg, '-') && strlen((string) $arg) > 1) {
                $chars = str_split(substr((string) $arg, 1));
                foreach ($chars as $char) {
                    $next = $this->args[0] ?? null;
                    $this->options[$char] = ($next && ! str_starts_with((string) $next, '-')) ? array_shift($this->args) : true;
                }
            } elseif (str_starts_with((string) $arg, '/')) {
                [$key, $value] = explode(':', substr((string) $arg, 1), 2) + [null, true];
                $this->options[$key] = $value;
            } else {
                $this->arguments[] = $arg;
            }
        }
    }

    public function getOption(string $name, mixed $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
