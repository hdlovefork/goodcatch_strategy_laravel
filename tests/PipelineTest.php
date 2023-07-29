<?php

namespace Tests;

use App\Services\Contract\Chain;

class PipelineTest extends TestCase
{
    /**
     * 能够按顺序执行中间件
     * @test
     */
    public function can_process_middleware_in_order()
    {
        $chainClass = new class implements Chain {
            public function handle(mixed $payload, $next)
            {
                $payload->count++;
                return $next($payload);
            }
        };

        $data = new \stdClass();
        $data->count = 0;
        $pipeline = new \App\Services\Pipeline();
        $pipeline->addStep(new $chainClass);
        $pipeline->addStep(new $chainClass);
        $pipeline->addStep(new $chainClass);
        $pipeline->process($data);
        $this->assertEquals(3, $data->count);
    }

    /**
     * 可以在中间件中直接返回结果，不再继续执行后续的中间件
     * @test
     */
    public function can_return_result_in_middleware()
    {
        $chainClass = new class implements Chain {
            public function handle(mixed $payload, $next)
            {
                $payload->count = 100;
                return false;
            }
        };

        $data = new \stdClass();
        $data->count = 0;
        $pipeline = new \App\Services\Pipeline();
        $pipeline->addStep(new $chainClass);
        $pipeline->addStep(new $chainClass);
        $pipeline->addStep(new $chainClass);
        $result = $pipeline->process($data);
        $this->assertEquals(100, $data->count);
        $this->assertFalse($result);
    }
}
