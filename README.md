# Radiate

[![Build Status](https://travis-ci.org/acairns/radiate.svg?branch=master)](https://travis-ci.org/acairns/radiate)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acairns/radiate/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/acairns/radiate/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/acairns/radiate/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/acairns/radiate/?branch=master)


---

Radiate is a package for managing Events.

## Basic Usage

Listeners are registered with an instance of the `Emitter` class.

### Creating the Emitter

Radiate requires a `MethodInflector` when being created - responsible for determining the method to be invoked on the listener.

```
use Cairns\Radiate\Emitter;
use Cairns\Radiate\Inflector\HandleMethodInflector;

$emitter = new Emitter(
    new HandleMethodInflector
);
```

### Inflectors

Several Inflectors are provided for common setups.

#### HandleMethodInflector

The `HandleMethodInflector` ensures the `handle()` method is returned.

```
final class DoSomething
{
    public function handle(SomeEvent $event)
    {
        // Do Something
    }
}
```

#### TypehintMethodInflector

The `TypehintMethodInflector` ensures any method dependent on the type of event is returned.

```
final class DoMoreStuff
{
    public function whenSomethingHappened(SomethingHappened $event)
    {
        // Do Something
    }

    public function whenItWorked(ItWorked $event)
    {
        // Do Something
    }
}
```

When using the `TypehintMethodInflector`, you can define multiple public methods so that the same Event Listener can respond to different events.


## Running tests
```
$ ./vendor/bin/phpunit
```

## Code Sniffer
```
$ ./vendor/bin/phpcs --standard=PSR2 ./src/
```

## Todo

[ ] Middleware Pipeline for Invoking an Event
