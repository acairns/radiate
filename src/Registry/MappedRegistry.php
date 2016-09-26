<?php namespace Cairns\Radiate\Registry;

final class MappedRegistry implements Registry
{
    private $listeners = [];

    public function register($event, $listener)
    {
        $this->listeners[$event][] = $listener;
    }

    public function find($event)
    {
        $eventClassName = get_class($event);

        if (! array_key_exists($eventClassName, $this->listeners)) {
            return [];
        }

        return $this->listeners[$eventClassName];
    }
}
