<?php namespace Cairns\Radiate\Tests\Registry;

use Cairns\Radiate\Registry\TypehintedClassRegistry;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class TypehintedClassRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TypehintedClassRegistry
     */
    private $registry;

    public function setUp()
    {
        $this->registry = new TypehintedClassRegistry;
    }

    public function test_it_registers_the_regular_listener_against_the_regular_event()
    {
        $event = new RegularEvent;

        $listener = new RegularListener;

        $this->registry->register($listener);

        $listeners = $this->registry->find($event);

        $this->assertContains($listener, $listeners);
    }
}
