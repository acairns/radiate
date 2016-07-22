<?php namespace Cairns\Radiate\Middleware;

use Cairns\Radiate\Locator\Locator;
use Cairns\Radiate\Inflector\MethodInflector;

class InvokeListenerMiddleware implements Middleware
{
    /**
     * @var MethodInflector
     */
    private $inflector;

    /**
     * @var Locator
     */
    private $locator;

    private $listeners;

    /**
     * @param MethodInflector $inflector
     * @param Locator $locator
     * @param string[] $listeners
     */
    public function __construct(MethodInflector $inflector, Locator $locator, $listeners)
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

            call_user_func_array([$listener, $method], func_get_args());
        }
    }
}
