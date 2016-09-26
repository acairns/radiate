<?php namespace Cairns\Radiate\Tests\Registry;

use Cairns\Radiate\Registry\MappedRegistry;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;

class MappedRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MappedRegistry
     */
    private $registry;

    public function setUp()
    {
        $this->registry = new MappedRegistry;
    }

    public function test_it_returns_empty_array_when_event_is_not_found()
    {
        $event = new RegularEvent;

        $listeners = $this->registry->find($event);

        $this->assertEmpty($listeners);
    }
}
