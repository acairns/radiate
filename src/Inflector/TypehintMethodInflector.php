<?php namespace Cairns\Radiate\Inflector;

use ReflectionClass;

final class TypehintMethodInflector implements MethodInflector
{
    public function inflect($event, $listener)
    {
        $class = new ReflectionClass($listener);

        $methods = $class->getMethods();

        foreach ($methods as $method) {
            if ($method->getNumberOfRequiredParameters() > 1) {
                continue;
            }

            $param = $method->getParameters()[0];

            if (get_class($event) != $param->getClass()->name) {
                continue;
            }

            return $method->name;
        }
    }
}
