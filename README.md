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

final class GoVeryFast
{
    public function whenWarpDriveIsEngaged(WarpDriveEngaged $event)
    {
        // make the ship go very fast!
    }
}

$emitter = new Cairns\Radiate\Emitter(
    new Cairns\Radiate\Inflector\TypehintMethodInflector
);

$emitter->addListener(new GoVeryFast);
$emitter->emit(new WarpDriveEngaged(9));
```

## Running tests
```
$ ./vendor/bin/phpunit
```

## Code Sniffer
```
$ ./vendor/bin/phpcs --standard=PSR2 ./src/
```

## Todo

- [ ] Middleware Pipeline for Invoking an Event
- [ ] Deal only with FQCN of Listeners to delay instance creation
- [ ] Bump to >=PHP7, update codebase (return types, typehint, etc.)
- [ ] Extract examples into example directory
