<?php namespace Cairns\Radiate\Tests\Inflector;

use Cairns\Radiate\Inflector\TypehintedInflector;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class TypehintedInflectorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_recognises_the_handle_method()
    {
        $inflector = new TypehintedInflector;

        $methods = $inflector->inflect(
            new RegularEvent,
            new RegularListener
        );

        $this->assertCount(1, $methods);
        $this->assertContains('handle', $methods);
    }
}
