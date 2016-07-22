<?php namespace Cairns\Radiate\Tests\Inflector;

use Cairns\Radiate\Inflector\HandleMethodInflector;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class HandleMethodInflectorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_the_string()
    {
        $inflector = new HandleMethodInflector;

        $methodName = $inflector->inflect(
            new RegularEvent,
            new RegularListener
        );

        $this->assertEquals('handle', $methodName);
    }

    public function test_it_does_not_return_the_handle_method_if_it_does_not_exist_on_the_listener()
    {
        $inflector = new HandleMethodInflector;

        $methodName = $inflector->inflect(
            new RegularEvent,
            new ListenerWithoutHandleMethod
        );

        $this->assertNull($methodName);
    }
}

class ListenerWithoutHandleMethod
{

}
