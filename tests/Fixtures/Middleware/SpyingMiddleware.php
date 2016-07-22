<?php namespace Cairns\Radiate\Tests\Fixtures\Middleware;

use Cairns\Radiate\Middleware\Middleware;

final class SpyingMiddleware implements Middleware
{
    private $event;

    /**
     * @param $event
     * @param callable $next
     */
    public function execute($event, callable $next)
    {
        $this->event = $event;
    }

    public function getEvent()
    {
        return $this->event;
    }
}
