<?php

declare(strict_types=1);

namespace S\Bases;

abstract class BaseCommand extends BaseArgument implements \Stringable, CommandInterface
{
    public function __invoke(...$args): bool
    {
        return $this->execute(...$args);
    }

    public function __toString(): string
    {
        $string = parent::__toString();
        foreach ($this->getActions() as $action) {
            $string .= ' '.$action->__toString();
        }

        return (string) $string;
    }
}
