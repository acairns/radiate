<?php namespace Cairns\Radiate\Tests;

use Cairns\Radiate\Emitter;
use Cairns\Radiate\Middleware\InvalidMiddlewareException;

class EmitterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_must_be_constructed_only_with_middleware()
    {
        $this->expectException(InvalidMiddlewareException::class);

        new Emitter([
            new \stdClass
        ]);
    }


}
