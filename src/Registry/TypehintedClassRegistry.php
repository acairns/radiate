<?php namespace Cairns\Radiate\Registry;

use ReflectionClass;

final class TypehintedClassRegistry implements Registry
{
    private $listeners;

    public function register($listener)
    {
        $class = new ReflectionClass($listener);

        $methods = $class->getMethods();

        foreach ($methods as $method) {
            if (! $method->isPublic()) {
                continue;
            }

            if ($method->getNumberOfParameters() !== 1) {
                continue;
            }

            if ($method->getNumberOfRequiredParameters() !== 1) {
                continue;
            }

            $param = $method->getParameters()[0];

            $type = $param->getType();

            if ($type->isBuiltin()) {
                continue;
            }

            $this->listeners[(string) $type][] = $listener;
        }
    }

    public function find($event)
    {
        $eventClassName = get_class($event);

        return $this->listeners[$eventClassName];
    }
}
