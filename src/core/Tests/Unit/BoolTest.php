<?php

declare(strict_types=1);

use S\Concretes\Cast;
use S\Contracts\IsBool;
use S\Contracts\IsScalar;
use S\Objects\BoolObject;

beforeEach(function () {
    $this->bool = Cast::toBool(true);
});

it('should be instantiable', function () {
    expect($this->bool)->toBeInstanceOf(BoolObject::class);
});

it('should be an instance of BoolType', function () {
    expect($this->bool)->toBeInstanceOf(IsBool::class);
});

it('should be an instance of ScalarType', function () {
    expect($this->bool)->toBeInstanceOf(IsScalar::class);
});

it('should return the value', function () {
    expect($this->bool->get())->toBe(true);
});
