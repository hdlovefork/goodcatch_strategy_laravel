<?php

namespace App\Services;

class ActivityManager
{
    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    public static function make($activities)
    {
        return new static($activities);
    }

    public function process($payload)
    {
        return (new Pipeline($this->activities))->process($payload);
    }
}
