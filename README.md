# Radiate

[![Build Status](https://travis-ci.org/acairns/radiate.svg?branch=master)](https://travis-ci.org/acairns/radiate)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acairns/radiate/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/acairns/radiate/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/acairns/radiate/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/acairns/radiate/?branch=master)

---

## Introduction

Radiate is a package for managing Events.

### Basic Usage

Simply create an instance of the `Emitter` and emit events!

```
$emitter new Emitter($middleware);
$emitter->emit(new ExampleEvent);
```

### Creating the Emitter

Radiate requires a pipeline of middleware when being created. The main middleware required to invoke listeners is an
instance of the `InvokeListenerMiddleware` class.

```
use Cairns\Radiate\Emitter;
use Cairns\Radiate\Inflector\HandleMethodInflector;
use Cairns\Radiate\Middleware\InvokeListenerMiddleware;

$invoker = new InvokeListenerMiddleware(
    $registry,
    $locator,
    $inflector
);

$emitter = new Cairns\Radiate\Emitter([
    $invoker
]);
```

In order to invoke a Listener, the middleware needs to know the available Listeners (`$registry`), how to create an
instance of the subscribed Listeners (`$locator`) and how to determine which method should be invoked (`$inflector`).

### Registrys

A Registry is a simple class responsible of keeping track all of the subscribed Listeners.

### Locators

The responsibility of the locator is to take a Fully Qualified Class Name for a Listener and to return an instance. If
you are using a Dependency Injection container, then this is where you want to resolve the concrete instance.

### Inflectors

The job of the inflector is to determine which method should be called on a particular Listener given a specific Event.
Several Inflectors are provided for common setups.

#### HandleMethodInflector

The `HandleMethodInflector` ensures the `handle()` method is returned. A Listener could look like this:

```
final class DisableTransporters
{
    public function handle(WarpDriveEngaged $event)
    {
        // Do Something
    }
}
```

#### TypehintMethodInflector

The `TypehintMethodInflector` ensures any method dependent on the type of event is returned. A Listener could look like
this:

```
final class DisableTransporters
{
    public function whenWarpDriveEngaged(WarpDriveEngaged $event)
    {
        // Do Something
    }

    public function whenShieldsWereRaised(ShieldsWereRaised $event)
    {
        // Do Something
    }
}
```

When using the `TypehintMethodInflector`, you can define multiple public methods so that the same Listener can respond
to different events.

## Simple Example

```php
final class WarpDriveEngaged
{
    private $speed;

    public function __construct($speed)
    {
        $this->speed = $speed;
    }

    public function getSpeed()
    {
        return $this->speed;
    }
}

final class DisableTransporters
{
    public function whenWarpDriveIsEngaged(WarpDriveEngaged $event)
    {
        // safety first!
    }
}

$registry = new \Cairns\Radiate\Registry\TypehintedClassRegistry;
$registry->register(DisableTransporters::class);

$locator = new Cairns\Radiate\Locator\InMemoryListenerLocator;
$locator->add(new DisableTransporters);

$invoker = new \Cairns\Radiate\Middleware\InvokeListenerMiddleware(
    $registry,
    $locator,
    new Cairns\Radiate\Inflector\TypehintMethodInflector
);

$emitter = new Cairns\Radiate\Emitter([
    $invoker
]);

$emitter->emit(new WarpDriveEngaged(9));
```

## Inspiration

This library is inspired by:

- [SimpleBus/MessageBus](https://github.com/SimpleBus/MessageBus)
- [thephpleague/tactician](https://github.com/thephpleague/tactician)
- [thephpleague/event](https://github.com/thephpleague/event)

## Contributing

Even though this is just an experiment for now, I'm totally open to ideas. Shoot over a PR!

If you decide to help out, here are some helpful things to check:

### Running tests
```
$ ./vendor/bin/phpunit
```

### Code Sniffer
```
$ ./vendor/bin/phpcs --standard=PSR2 ./src/
```

## Todo

- [ ] Bump to >=PHP7, update codebase (return types, typehint, etc.)
- [ ] Extract examples into example directory
- [ ] Make registry serialisable, and constructable from a serialised registry
