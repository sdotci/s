<?php

declare(strict_types=1);

arch('strict')
    ->expect('S\\')
    ->toUseStrictTypes();

arch()
    ->preset()
    ->php()
    ->ignoring('debug_backtrace');

arch()
    ->preset()
    ->security()
    ->ignoring(['extract', 'parse_str']);

arch('bases')
    ->expect('S\Bases')
    ->classes()
    ->toBeAbstract()
    ->toHavePrefix('Base');

arch('concerns')
    ->expect('S\Concerns')
    ->traits()
    ->toOnlyBeUsedIn(['S\Bases', 'S\Concerns', 'S\Exceptions', 'S\Samples']);

arch('contracts')
    ->expect('S\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn(['S\Bases', 'S\Contracts', 'S\Exceptions', 'S\Samples']);

arch('enums')
    ->expect('S\Enums')
    ->enums()
    ->toOnlyBeUsedIn(['S\Bases', 'S\Types', 'S\Concerns', 'S\Contracts']);

arch('objects')
    ->expect('S\Objects')
    ->classes()
    ->toHaveSuffix('Object')
    ->toHaveConstructor();

arch('types')
    ->expect('S\Types')
    ->classes()
    ->toHaveSuffix('Type')
    ->toExtend(\S\Foundation\Type::class);
