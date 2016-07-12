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
}
