<?php namespace Cairns\Radiate\Inflector;

interface MethodNameInflector
{
    public function inflect($event, $listener);
}
