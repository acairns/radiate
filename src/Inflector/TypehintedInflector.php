<?php namespace Cairns\Radiate\Inflector;

use ReflectionClass;

final class TypehintedInflector implements MethodInflector
{
    public function inflect($event, $listener)
    {
        $class = new ReflectionClass($listener);
        $methods = $class->getMethods();

        $matched = [];

        foreach ($methods as $method) {
            $params = $method->getParameters();

            if (count($params) > 1) {
                continue;
            }

            if (get_class($event) != $params[0]->getClass()->name) {
                continue;
            }

            $matched[] = $method->name;
        }

        return $matched;
    }
}
