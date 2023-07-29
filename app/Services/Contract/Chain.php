<?php

namespace App\Services\Contract;

/**
 * 链式任务
 */
interface Chain
{
    /**
     * 处理当前任务并传递给下一个任务
     * @param $payload mixed 任务数据
     * @param $next callable 下一个任务 function($payload){}
     * @return mixed 处理结果
     */
    public function handle(mixed $payload, $next);
}
