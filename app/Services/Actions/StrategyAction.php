<?php

namespace App\Services\Actions;

use App\Services\Contract\Action;
use App\Services\Contract\StrategyBundle;

abstract class StrategyAction implements Action
{
    protected mixed $payload;
    protected StrategyBundle $strategyBundle;

    public function __construct($payload, $strategy)
    {
        $this->payload = $payload;
        $this->strategyBundle = $strategy;
    }
}
