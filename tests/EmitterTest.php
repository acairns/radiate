<?php namespace Cairns\Radiate\Tests;

use Cairns\Radiate\Emitter;
use Cairns\Radiate\Inflector\HandleMethodInflector;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class EmitterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_accepts_a_new_listener()
    {
        $emitter = new Emitter(
            new HandleMethodInflector
        );

        $emitter->addListener(
            new RegularListener
        );

        $this->assertCount(1, $emitter->getListeners());
    }

    public function test_emitted_events_invoke_listener()
    {
        $event = new RegularEvent;

        $listener = $this->prophesize(RegularListener::class);
        $listener->handle($event)->shouldBeCalled();

        $emitter = new Emitter(
            new HandleMethodInflector
        );

        $emitter->addListener($listener->reveal());

        $emitter->emit($event);
    }

    public function test_it_passes_additional_arguments_to_the_listener()
    {
        $event = new RegularEvent;

        $listener = $this->prophesize(RegularListener::class);
        $listener->handle($event, 'one', 'two', 'three')->shouldBeCalled();

        $emitter = new Emitter(
            new HandleMethodInflector
        );

        $emitter->addListener($listener->reveal());

        $emitter->emit($event, 'one', 'two', 'three');
    }
}
