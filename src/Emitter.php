<?php namespace Cairns\Radiate;

use Cairns\Radiate\Inflector\MethodInflector;

final class Emitter
{
    private $inflector;

    private $listeners = [];

    public function __construct(MethodInflector $inflector)
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
            $method = $this->inflector->inflect($event, $listener);

            if (! method_exists($listener, $method)) {
                continue;
            }

            $listener->{$method}($event);
        }
    }
}
