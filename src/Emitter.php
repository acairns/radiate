<?php namespace Cairns\Radiate;

use Cairns\Radiate\Middleware\Middleware;
use Cairns\Radiate\Middleware\InvalidMiddlewareException;

final class Emitter
{
    private $chain;

    /**
     * @param Middleware[] $middleware
     */
    public function __construct($middleware)
    {
        $this->chain = $this->createChain($middleware);
    }

    public function emit($event)
    {
        return $this->chain($event);
    }

    private function createChain($middleware)
    {
        $last = function () {
            // nothing
        };

        while ($link = array_pop($middleware)) {
            if (! $link instanceof Middleware) {
                throw new InvalidMiddlewareException('Shitballs!');
            }

            $last = function ($event) use ($link, $last) {
                return $link->execute($event, $last);
            };
        }

        return $last;
    }
}
