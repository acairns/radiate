<?php require_once __DIR__ . '/vendor/autoload.php';

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
        var_dump($event);

        echo "Disabling Transporters!\n";
    }
}

final class NewInstanceListenerLocator implements \Cairns\Radiate\Locator\ListenerLocator {
    public function locate($fqcn) {
        return new $fqcn;
    }
}

$registry = new \Cairns\Radiate\Registry\TypehintedClassRegistry;
$registry->register(DisableTransporters::class);

$invoker = new \Cairns\Radiate\Middleware\InvokeListenerMiddleware(
    $registry,
    new NewInstanceListenerLocator,
    new Cairns\Radiate\Inflector\TypehintMethodInflector
);

$emitter = new Cairns\Radiate\Emitter([
    $invoker
]);

$emitter->emit(new WarpDriveEngaged(9));
