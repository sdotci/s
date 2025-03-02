<?php

declare(strict_types=1);

use S\Foundation\Concretes\Cast;
use S\Foundation\Contracts\IsInt;
use S\Foundation\Contracts\IsNumber;
use S\Objects\IntObject;

beforeEach(function () {
    $this->int = Cast::toInt(42);
});

it('should be instantiable', function () {
    expect($this->int)->toBeInstanceOf(IntObject::class);
});

it('should be an instance of IntType', function () {
    expect($this->int)->toBeInstanceOf(IsInt::class);
});

it('should be an instance of NumberType', function () {
    expect($this->int)->toBeInstanceOf(IsNumber::class);
});

it('should return the value', function () {
    expect($this->int->get())->toBe(42);
});
