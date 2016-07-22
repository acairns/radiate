<?php namespace Cairns\Radiate\Middleware;

interface Middleware
{
    public function execute($event, callable $next);
}
