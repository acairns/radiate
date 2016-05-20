<?php namespace Cairns\Radiate\Inflector;

use ReflectionClass;

final class TypehintedInflector implements MethodNameInflector
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

            if (get_class($event) != $params[0]->getType()) {
                continue;
            }

            $matched[] = $method->getName();
        }

        return $matched;
    }
}
