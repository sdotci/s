<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Result;

class Program
{
    protected int $argc = 0;

    /** @var list<string> */
    protected array $argv = [];

    protected array $commands = [];

    public function __construct(?int $argc = null, ?array $argv = null)
    {
        $this->argv = (array) ($argv ?? $_SERVER['argv'] ?? []);
        $this->argc = (int) ($argc ?? $_SERVER['argc'] ?? count($this->argv));
    }

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
    public function run(): never
    {
        $args = $this->argv;
        $count = $this->argc;

        if ($count !== count($args)) {
            exit_error('Wrong arguments count');
        }

        if ($count < 1) {
            exit_error('No argument given');
        }

        $arg0 = $args[0];
        $binFile = realpath($arg0);
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
