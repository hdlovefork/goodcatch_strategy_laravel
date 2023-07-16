<?php

namespace Tests;

use App\Services\Strategy\StrategyManager;

class StrategyTest extends TestCase
{
    /**
     * 应该满足between策略
     * @test
     */
    public function should_satisfy_between_strategy(){
        // 配置示例
        $config = [
            'operator' => 'and', // 可选值: 'or', 'and
            'conditions' => [
                [
                    'field' => 'age',
                    'operator' => 'between',
                    'value' => [18, 30]
                ]
            ]
        ];

        // 生成测试数据
        $testData = [
            ['age' => 20],
            ['age' => 25],
            ['age' => 30],
            ['age' => 17],
            ['age' => 31],
        ];

        // 断言
        $result = StrategyManager::make($config)->resolve($testData);
        $this->assertCount(3, $result);
    }


    /**
     * 应该满足and和or策略
     * @test
     */
    public function should_satisfy_and_and_or_strategy(){
        // 配置示例
        $config = [
            'operator' => 'and', // 可选值: 'or', 'and'
            'conditions' => [
                [
                    'operator' => 'and',
                    'conditions' => [
                        [
                            'field' => 'age',
                            'operator' => '>=',
                            'value' => 18
                        ],
                        [
                            'field' => 'gender',
                            'operator' => '=',
                            'value' => 'female'
                        ]
                    ]
                ],
                [
                    'field' => 'occupation',
                    'operator' => '=',
                    'value' => 'student'
                ],
                [
                    'operator' => 'or',
                    'conditions' => [
                        [
                            'field' => 'city',
                            'operator' => '=',
                            'value' => 'New York'
                        ],
                        [
                            'field' => 'city',
                            'operator' => '=',
                            'value' => 'Los Angeles'
                        ]
                    ]
                ]
            ]
        ];

        // 生成测试数据
        $testData = [
            ['age' => 20, 'gender' => 'female', 'occupation' => 'student', 'city' => 'New York'],
            ['age' => 25, 'gender' => 'male', 'occupation' => 'teacher', 'city' => 'Los Angeles'],
            ['age' => 30, 'gender' => 'female', 'occupation' => 'engineer', 'city' => 'Chicago'],
            ['age' => 17, 'gender' => 'male', 'occupation' => 'student', 'city' => 'New York'],
            ['age' => 21, 'gender' => 'female', 'occupation' => 'student', 'city' => 'Los Angeles'],
            ['age' => 20, 'gender' => 'female', 'occupation' => 'engineer', 'city' => 'New York'],
        ];

        $result = StrategyManager::make($config)->resolve($testData);

        $this->assertCount(2, $result);
        $this->assertEquals(20, $result[0]['age']);
        $this->assertEquals('New York', $result[0]['city']);
        $this->assertEquals(21, $result[1]['age']);
        $this->assertEquals('Los Angeles', $result[1]['city']);
    }
}
