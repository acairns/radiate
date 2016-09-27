<?php namespace Cairns\Radiate\Recorder;

final class InMemoryRecorder implements Recorder
{
    private $events = [];

    public function release()
    {
        $events = $this->events;

        $this->clear();

        return $events;
    }

    public function clear()
    {
        $this->events = [];
    }

    public function record($events)
    {
        $this->events = array_merge($this->events, $events);
    }
}
