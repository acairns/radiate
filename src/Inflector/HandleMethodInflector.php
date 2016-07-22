<?php namespace Cairns\Radiate\Inflector;

final class HandleMethodInflector implements MethodInflector
{
    public function inflect($event, $listener)
    {
        $method = 'handle';

        if (! method_exists($listener, $method)) {
            return null;
        }

        return $method;
    }
}
