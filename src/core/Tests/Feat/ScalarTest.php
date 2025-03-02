<?php

declare(strict_types=1);

use S\Foundation\Concretes\Cast;
use S\Foundation\Contracts\IsMixed;
use S\Foundation\Contracts\IsScalar;
use S\Objects\ScalarObject;

beforeEach(function () {
    $this->scalar = Cast::toScalar('Hello World');
});

it('should be instantiable', function () {
    expect($this->scalar)->toBeInstanceOf(ScalarObject::class);
});

it('should be an instance of ScalarType', function () {
    expect($this->scalar)->toBeInstanceOf(IsScalar::class);
});

it('should be an instance of MixedType', function () {
    expect($this->scalar)->toBeInstanceOf(IsMixed::class);
});

it('should return the value', function () {
    expect($this->scalar->get())->toBe('Hello World');
});
