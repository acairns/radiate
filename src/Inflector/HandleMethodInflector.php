<?php namespace Cairns\Radiate\Inflector;

final class HandleMethodInflector implements MethodInflector
{
    public function inflect($event, $listener)
    {
        return 'handle';
    }
}
