<?php namespace Cairns\Radiate\Recorder;

interface Recorder
{
    public function release();

    public function clear();

    public function record($events);
}
