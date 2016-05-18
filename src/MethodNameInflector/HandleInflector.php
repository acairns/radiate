<?php namespace Cairns\Radiate\MethodNameInflector;

final class HandleInflector implements MethodNameInflector
{
    public function inflect($event)
    {
        return 'handle';
    }
}
