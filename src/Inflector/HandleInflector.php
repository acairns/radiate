<?php namespace Cairns\Radiate\Inflector;

final class HandleInflector implements MethodNameInflector
{
    public function inflect($event, $listener)
    {
        return 'handle';
    }
}
