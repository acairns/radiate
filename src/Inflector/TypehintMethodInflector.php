<?php namespace Cairns\Radiate\Inflector;

use ReflectionClass;

final class TypehintMethodInflector implements MethodInflector
{
    public function inflect($event, $listener)
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

            if (get_class($event) !== (string) $type) {
                continue;
            }

            return $method->name;
        }
    }
}
