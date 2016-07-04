<?php namespace Cairns\Radiate\Inflector;

interface MethodInflector
{
    public function inflect($event, $listener) : string;
}
