<?php namespace Cairns\Radiate\Tests;

use Cairns\Radiate\Emitter;
use Cairns\Radiate\Middleware\InvalidMiddlewareException;
use Cairns\Radiate\Tests\Fixtures\Middleware\SpyingMiddleware;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;

class EmitterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_must_be_constructed_only_with_middleware()
    {
        $this->expectException(InvalidMiddlewareException::class);

        new Emitter([
            new \stdClass
        ]);
    }

    public function test_it_successfully_creates_a_middleware_pipeline()
    {
        $spy = new SpyingMiddleware;

        $emitter = new Emitter([
            $spy
        ]);

        $this->assertNull($spy->getEvent());

        $emitter->emit(new RegularEvent);

        $this->assertInstanceOf(RegularEvent::class, $spy->getEvent());
    }
}
