<?php

namespace App\Services\Actions;

/**
 * 中奖动作
 */
class WinAction extends StrategyAction
{
    public function execute($data)
    {
        return '中奖了';
    }
}
