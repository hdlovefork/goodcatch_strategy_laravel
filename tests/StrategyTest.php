<?php

namespace Tests;

use App\Models\Condition;
use App\Models\Strategy;
use Laravel\Lumen\Testing\DatabaseMigrations;

class StrategyTest extends TestCase
{
    use DatabaseMigrations, TestDataMigration;

    /**
     * 传入一个简单条件可以生成一条策略规则
     * @test
     */
    public function can_create_a_strategy_with_a_simple_condition()
    {
        $strategy = Strategy::createWithRule([
            'operator' => 'between',
            'field' => 'age',
            'value' => '18,30'
        ]);

        $this->assertNotNull($strategy);
        $this->assertEquals([
            'operator' => 'between',
            'field' => 'age',
            'value' => '18,30'
        ], $strategy->toRule());

        $this->assertCount(0, $strategy->strategies);
        $this->assertCount(1, $strategy->conditions);
    }

    /**
     * 传入一个复杂条件可以生成一条策略规则
     * @test
     */
    public function can_create_a_strategy_with_a_complex_condition()
    {
        $rule = [
            'operator' => 'and',
            // 条件或称为策略组
            'conditions' => [
                //条件a
                [
                    'operator' => '=',
                    'field' => 'age',
                    'value' => '18',
                ],
                // 条件b
                [
                    'operator' => '=',
                    'field' => 'gender',
                    'value' => '女'
                ],
                // 条件c 或者 称为策略组
                [
                    'operator' => 'or',
                    'conditions' => [
                        // 条件c2
                        [
                            'operator' => '=',
                            'field' => 'city',
                            'value' => '北京'
                        ],
                        [
                            'operator' => '=',
                            'field' => 'city',
                            'value' => '成都'
                        ]
                    ]
                ]
            ]
        ];

        $strategy = Strategy::createWithRule($rule);
        $this->assertNotNull($strategy);
        $this->assertEquals($rule, $strategy->toRule());
    }

    /**
     * 传入一个复杂条件可以生成数据库中的多条策略和条件数据
     * @test
     */
    public function can_create_strategies_with_a_complex_condition()
    {
        $rule = [
            'operator' => 'and',
            // 条件或称为策略组
            'conditions' => [
                //条件a
                [
                    'operator' => '=',
                    'field' => 'age',
                    'value' => '18',
                ],
                // 条件b
                [
                    'operator' => '=',
                    'field' => 'gender',
                    'value' => '女'
                ],
                // 条件c 或者 称为策略组
                [
                    'operator' => 'or',
                    'conditions' => [
                        // 条件c2
                        [
                            'operator' => '=',
                            'field' => 'city',
                            'value' => 'beijing'
                        ]
                    ]
                ]
            ]
        ];

        $strategy = Strategy::createWithRule($rule);

        $this->assertEquals(2, $strategy->conditions()->count());
        $this->assertEquals(1, $strategy->strategies()->count());

        $this->assertEquals(['18', '女'], $strategy->conditions->pluck('value')->toArray());

        $this->assertEquals(2, Strategy::all()->count());
        $this->assertEquals(3, Condition::all()->count());
        $this->assertEquals('and', $strategy->operator->name);
        $this->assertEquals('or', $strategy->strategies->first()->operator->name);
    }
}
