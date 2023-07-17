<?php

namespace App\Services\Strategy;

/**
 * Not策略
 */
class NotStrategy implements StrategyInterface
{
    private $strategy;

    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    public function isSatisfied(mixed $data): bool
    {
        return !$this->strategy->isSatisfied($data);
    }
}
