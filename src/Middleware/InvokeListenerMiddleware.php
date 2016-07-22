<?php namespace Cairns\Radiate\Middleware;

use Cairns\Radiate\Locator\ListenerLocator;
use Cairns\Radiate\Inflector\MethodInflector;

class InvokeListenerMiddleware implements Middleware
{
    /**
     * @var MethodInflector
     */
    private $inflector;

    /**
     * @var ListenerLocator
     */
    private $locator;

    /**
     * @var string[]
     */
    private $listeners;

    /**
     * @param MethodInflector $inflector
     * @param ListenerLocator $locator
     * @param string[] $listeners
     */
    public function __construct(MethodInflector $inflector, ListenerLocator $locator, $listeners)
    {
        $this->inflector = $inflector;

        $this->locator = $locator;

        $this->listeners = $listeners;
    }

    public function execute($event, callable $next)
    {
        foreach ($this->listeners as $listener) {
            $method = $this->inflector->inflect($event, $listener);

            if (! $method) {
                continue;
            }

            $listener = $this->locator->locate($listener);

            $listener->$method($event);
        }
    }
}
