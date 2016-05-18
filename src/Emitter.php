<?php namespace Cairns\Radiate;

use Cairns\Radiate\Inflector\MethodNameInflector;

final class Emitter
{
    private $inflector;

    private $listeners = [];

    public function __construct(MethodNameInflector $inflector)
    {
        $this->inflector = $inflector;
    }

    public function addListener($listener)
    {
        $this->listeners[] = $listener;
    }

    public function getListeners()
    {
        return $this->listeners;
    }

    public function emit($event)
    {
        foreach ($this->listeners as $listener) {
            $methodName = $this->inflector->inflect($event);

            if (! method_exists($listener, $methodName)) {
                continue;
            }

            $listener->{$methodName}($event);
        }
    }
}
