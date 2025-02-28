<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Result;

class Program
{
    protected array $commands = [];

    public function __construct(protected string $name = '', protected string $version = '') {}

    /**
     * @param  array<callable-string|callable-object>|array{object|class-string,string}|callable-string|callable-object|callable(mixed ...$args): mixed  $handler
     */
    public function on(string $signature, array|string|object|callable $handler, ?string $name = null, ?string $description = null): Command
    {
        return $this->add(new Command($signature, $handler, $name, $description));
    }

    public function add(Command $command): Command
    {
        $this->commands[] = $command;

        return $command;
    }

    /**
     * @param  null|array<string>  $argv
     **/
    public function run(?int $argc = null, ?array $argv = null): never
    {
        /** @var array<string> */
        $args = $argv ?? $_SERVER['argv'] ?? [];
        $count ??= $argc ?? count($args);

        if ($count !== count($args)) {
            exit_error('Wrong arguments count');
        }

        if ($count < 1) {
            exit_error('No argument given');
        }

        $argv0 = $argv[0];
        $binFile = realpath($argv0);
        $args = array_slice($args, 1);

        foreach ($this->commands as $command) {
            if ($command->match(implode(' ', $args))) {
                $command->resolve()->send();
            }
        }

        $result = new Result('No command matched'.PHP_EOL);
        $result->send();
    }
}
