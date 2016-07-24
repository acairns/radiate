<?php namespace Cairns\Radiate\Tests\Inflector;

use Cairns\Radiate\Inflector\TypehintMethodInflector;
use Cairns\Radiate\Tests\Fixtures\RegularEvent;
use Cairns\Radiate\Tests\Fixtures\RegularListener;

class TypehintMethodInflectorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_recognises_the_handle_method()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new RegularListener
        );

        $this->assertContains('handle', $method);
    }

    public function test_it_ignores_methods_which_are_not_public()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithNonPublicMethods
        );

        $this->assertNull($method);
    }

    public function test_it_ignores_listeners_without_any_methods()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithoutAnyMethods
        );

        $this->assertNull($method);
    }

    public function test_it_ignores_listener_methods_without_parameters()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithoutAnyMethods
        );

        $this->assertNull($method);
    }

    public function test_it_ignores_listener_methods_with_multiple_required_parameters()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithMethodRequiringMultipleParameters
        );

        $this->assertNull($method);
    }

    public function test_it_ignores_methods_which_do_not_have_exactly_one_parameter_which_is_also_required()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithMethodContainingOptionalParams
        );

        $this->assertNull($method);
    }

    public function test_it_ignores_methods_when_typehints_do_not_match()
    {
        $inflector = new TypehintMethodInflector;

        $method = $inflector->inflect(
            new RegularEvent,
            new ListenerWithMethodThatDoesNotMatchEvent
        );

        $this->assertNull($method);
    }
}

class ListenerWithoutAnyMethods {}

class ListenerWithMethodWithoutParameters
{
    public function handleSomething()
    {

    }
}

class ListenerWithMethodRequiringMultipleParameters
{
    public function handleSomething(RegularEvent $event, $required)
    {

    }
}

class ListenerWithNonPublicMethods
{
    private function privateMethod()
    {

    }

    protected function protectedMethod()
    {

    }
}

class ListenerWithMethodContainingOptionalParams
{
    public function handle($optional = 1, RegularEvent $event)
    {

    }
}

class ListenerWithMethodThatDoesNotMatchEvent
{
    public function handle(\stdClass $event)
    {

    }
}
