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
use Cairns\Radiate\Inflector\HandleInflector;

$emitter = new Emitter(
    new HandleInflector
);
```

### Inflectors

Several Inflectors are provided for common setups.

The `HandleInflector` ensures the `handle()` method is returned.

The `TypehintedInflector` ensures any method dependent on the type of event is returned.


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
