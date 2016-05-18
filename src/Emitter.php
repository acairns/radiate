<?php namespace Cairns\Radiate;

final class Emitter
{
    private $listeners = [];

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
            $listener->handle($event);
        }
    }
}
