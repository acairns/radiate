<?php namespace Cairns\Radiate\Tests\Inflector;

use Cairns\Radiate\Inflector\HandleInflector;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;

class HandleInflectorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_the_string()
    {
        $inflector = new HandleInflector;

        $this->assertEquals('handle', $inflector->inflect(new RegularEvent));
    }
}
