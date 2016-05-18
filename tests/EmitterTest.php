<?php namespace Cairns\Radiate\Tests;

use Cairns\Radiate\Emitter;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class EmitterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_accepts_a_new_listener()
    {
        $emitter = new Emitter;
        $emitter->addListener(
            new RegularListener
        );

        $this->assertCount(1, $emitter->getListeners());
    }
}
