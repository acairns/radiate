<?php namespace Cairns\Radiate\Middleware;

use Cairns\Radiate\Inflector\MethodInflector;
use Cairns\Radiate\Registry\Registry;
use Cairns\Radiate\Locator\ListenerLocator;

class InvokeListenerMiddleware implements Middleware
{
    /**
     * @var Registry
     */
    private $listeners;

    /**
     * @var ListenerLocator
     */
    private $locator;

    /**
     * @var MethodInflector
     */
    private $inflector;

    /**
     * @param Registry $listeners
     * @param ListenerLocator $locator
     * @param MethodInflector $inflector
     */
    public function __construct(Registry $listeners, ListenerLocator $locator, MethodInflector $inflector)
    {
        $this->listeners = $listeners;

        $this->locator = $locator;

        $this->inflector = $inflector;
    }

    public function execute($event, callable $next)
    {
        $listeners = $this->listeners->find($event);

        if (! $listeners) {
            return;
        }

        foreach ($listeners as $listener) {
            $method = $this->inflector->inflect($event, $listener);

            if (! $method) {
                continue;
            }

            $listener = $this->locator->locate($listener);

            call_user_func([$listener, $method], $event);
        }
    }
}
