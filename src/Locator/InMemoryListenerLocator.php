<?php namespace Cairns\Radiate\Locator;

final class InMemoryListenerLocator implements ListenerLocator
{
    private $listeners;

    public function __construct($listeners)
    {
        $this->listeners = $listeners;
    }

    public function locate($fqcn)
    {
        return $this->listeners[$fqcn];
    }
}
