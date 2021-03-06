<?php namespace Cairns\Radiate\Tests\Middleware;

use Cairns\Radiate\Registry\MappedRegistry;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Locator\InMemoryListenerLocator;
use Cairns\Radiate\Inflector\HandleMethodInflector;
use Cairns\Radiate\Middleware\InvokeListenerMiddleware;

class InvokeListenerMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_calls_inflected_method_on_located_listener()
    {
        $listener = new TrackingListener;

        $locator = new InMemoryListenerLocator;
        $locator->add($listener);

        $registry = new MappedRegistry;
        $registry->register(RegularEvent::class, TrackingListener::class);

        $middleware = new InvokeListenerMiddleware(
            $registry,
            $locator,
            new HandleMethodInflector
        );

        $this->assertFalse($listener->hasBeenCalled());

        $middleware->execute(new RegularEvent, function () {});

        $this->assertTrue($listener->hasBeenCalled());
    }
}

class TrackingListener
{
    private $called = false;

    public function handle(RegularEvent $event)
    {
        $this->called = true;
    }

    public function hasBeenCalled()
    {
        return $this->called;
    }
}
