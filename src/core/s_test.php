<?php

declare(strict_types=1);

use S\Concretes\Backtrace;
use S\Concretes\Container;
use S\Contracts\IsAccessible;
use S\Contracts\IsEncapsulated;
use S\Contracts\IsModifiable;
use S\Contracts\IsResolvable;
use S\Exceptions\NotFound;
use S\Samples\CustomClass;

beforeEach(function () {
    $this->trace = new Backtrace;
    $this->helperTrace = backtrace();
});

it('should be an instance of "'.Backtrace::class.'"', function () {
    expect($this->helperTrace)->toBeInstanceOf(Backtrace::class);
    expect($this->trace)->toBeInstanceOf(Backtrace::class);
});

test('its helper should match its class', function () {
    expect($this->helperTrace->getFile())->toEqual($this->trace->getFile());
    expect($this->helperTrace->getDirectory())->toEqual($this->trace->getDirectory());
});

beforeEach(function () {
    $this->container = new CustomClass('S');
});

it('should be encapsulated', function () {
    expect($this->container)
        ->toBeInstanceOf(IsEncapsulated::class)
        ->toBeInstanceOf(IsAccessible::class)
        ->toBeInstanceOf(IsModifiable::class)
        ->toBeInstanceOf(IsResolvable::class);
});

it('should be resolvable', function () {
    $hello = fn (?string $name = null) => 'Hello '.($name ?? 'S').'!';
    CustomClass::onStatic('hello', $hello);
    $this->container->on('hello', $hello);

    expect(CustomClass::hello())
        ->toEqual($this->container->hello())
        ->toEqual('Hello S!');
});

it('should set and get name', function () {
    $container = $this->container;
    $container->name = 'Capsule';

    expect($container->name)
        ->toEqual('Capsule');
});

it('throws a not found exception when not encapsulable', function () {
    expect(fn () => $this->container->age)
        ->toThrow(NotFound::class, 'Unable to get property age.');

    expect(fn () => $this->container->age = 22)
        ->toThrow(NotFound::class, 'Unable to set property age.');

    expect(fn () => $this->container->hi())
        ->toThrow(NotFound::class, 'Could not find action hi.');

    expect(fn () => CustomClass::hi())
        ->toThrow(NotFound::class, 'Could not find static action hi.');
});

it('should provide the components', function () {
    $c = new Container([
        'class' => CustomClass::class,
        CustomClass::class => [
            'name' => 'S',
            'year' => date('Y'),
        ],
        CustomInterface::class => new CustomClass,
    ]);

    expect($c)->toBeInstanceOf(Container::class);
    expect($class = $c->get('class'))->toBeInstanceOf(CustomClass::class);
    expect($interface = $c->get(CustomInterface::class))->toBeInstanceOf(CustomClass::class);
    expect($class->getName())->toEqual('S');
    expect($interface->getName())->toEqual('World');
});
