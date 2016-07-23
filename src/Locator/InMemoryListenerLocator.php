<?php namespace Cairns\Radiate\Locator;

final class InMemoryListenerLocator implements ListenerLocator
{
    /**
     * @var object[]
     */
    private $listeners;

    /**
     * @param object $listener
     */
    public function add($listener)
    {
        $this->listeners[get_class($listener)] = $listener;
    }

    /**
     * @param string $fqcn
     * @return object
     */
    public function locate($fqcn)
    {
        return $this->listeners[$fqcn];
    }
}
