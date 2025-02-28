<?php

declare(strict_types=1);

use S\Concretes\Cast;
use S\Contracts\IsFloat;
use S\Contracts\IsNumber;
use S\Objects\FloatObject;

beforeEach(function () {
    $this->float = Cast::toFloat(84.21);
});

it('should be instantiable', function () {
    expect($this->float)->toBeInstanceOf(FloatObject::class);
});

it('should be an instance of FloatType', function () {
    expect($this->float)->toBeInstanceOf(IsFloat::class);
});

it('should be an instance of NumberType', function () {
    expect($this->float)->toBeInstanceOf(IsNumber::class);
});

it('should return the value', function () {
    expect($this->float->get())->toBe(84.21);
});
