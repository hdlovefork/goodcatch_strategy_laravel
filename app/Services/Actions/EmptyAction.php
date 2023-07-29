<?php

namespace App\Services\Actions;

/**
 * 空动作，默认动作
 */
class EmptyAction extends StrategyAction
{
    public function execute($data)
    {
        return '';
    }
}
