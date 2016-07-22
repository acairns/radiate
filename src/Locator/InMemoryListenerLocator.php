<?php namespace Cairns\Radiate\Locator;

final class InMemoryLocator implements Locator
{
    private $things;

    public function __construct($things)
    {
        $this->things = $things;
    }

    public function locate($fqcn)
    {
        return $this->things[$fqcn];
    }
}
