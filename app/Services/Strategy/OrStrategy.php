<?php

namespace App\Services\Strategy;

class OrStrategy implements StrategyInterface {
    private $strategies;

    public function __construct($strategies) {
        $this->strategies = $strategies;
    }

    public function isSatisfied(mixed $data): bool
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->isSatisfied($data)) {
                return true;
            }
        }
        return false;
    }
}
