<?php

namespace App\Services;

use App\Services\Contract\Chain;

class Pipeline
{
    private $steps;

    public function __construct($steps = [])
    {
        $this->steps = $steps;
    }

    public function addStep(Chain $step)
    {
        $this->steps[] = $step;
    }

    /**
     *
     * @param $payload
     * @return mixed
     */
    public function process($payload)
    {
        $currentIndex = 0;

        $next = function ($payload) use (&$next, &$currentIndex) {
            if ($currentIndex < count($this->steps)) {
                $step = $this->steps[$currentIndex];
                $currentIndex++;
                return $step->handle($payload, $next);
            } else {
                return $payload;
            }
        };

        return $next($payload);
    }

    public function clearSteps()
    {
        $this->steps = [];
    }
}
