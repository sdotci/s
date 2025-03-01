<?php

declare(strict_types=1);

namespace S\Foundation\Cli;

use S\Foundation\Application as BaseApplication;
use S\Foundation\Result;

class Application extends BaseApplication
{
    protected array $commands = [];

    public function __construct(Context $context)
    {
        parent::__construct($context);
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

    public function run(): never
    {
        $context = $this->context;
        $input = $this->context->getInput();

        $arg0 = $input->get(0);

        $binFile = realpath($arg0);
        $input->remove(0);

        foreach ($this->commands as $command) {
            if ($command->match(implode(' ', $input->getData()))) {
                $context->withAttributes($command->getMatches());
                $command->resolve($context)->send();
            }
        }

        $result = new Result('No command matched'.PHP_EOL);
        $result->send();
    }
}
