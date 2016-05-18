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
}
