<?php namespace Cairns\Radiate;

use Cairns\Radiate\Middleware\Middleware;
use Cairns\Radiate\Middleware\InvalidMiddlewareException;

final class Emitter
{
    /**
     * @var callable
     */
    private $pipeline;

    /**
     * @param Middleware[] $middleware
     */
    public function __construct($middleware)
    {
        $this->pipeline = $this->createChain($middleware);
    }

    /**
     * @param $event
     * @return mixed
     */
    public function emit($event)
    {
        $pipeline = $this->pipeline;

        return $pipeline($event);
    }

    /**
     * @param Middleware[] $middleware
     * @return callable
     */
    private function createChain($middleware)
    {
        $last = function () {
            // nothing
        };

        while ($link = array_pop($middleware)) {
            if (! $link instanceof Middleware) {
                throw new InvalidMiddlewareException;
            }

            $last = function ($event) use ($link, $last) {
                return $link->execute($event, $last);
            };
        }

        return $last;
    }
}
