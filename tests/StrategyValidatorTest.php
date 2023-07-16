<?php

namespace Tests;

use App\Services\Strategy\StrategyConfigValidator;

class StrategyValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function should_validate_config()
    {
        $config = [
            'operator' => 'and',
            'conditions' => [
                [
                    'field' => 'age',
                    'operator' => 'between',
                    'value' => [18, 30]
                ]
            ]
        ];

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function should_validate_config2()
    {
        $config = [
            'field' => 'age',
            'operator' => 'between',
            'value' => [18, 30]
        ];

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function should_validate_config3()
    {
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

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function should_validate_config4()
    {
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

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function should_validate_config5()
    {
        $config = [
            'operator' => 'and', // 可选值: 'or', 'and'
            'conditions' => [
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

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function should_validate_config6()
    {
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
                ]
            ]
        ];

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function should_validate_config7()
    {
        $config = [
            'operator' => 'and', // 可选值: 'or', 'and'
            'conditions' => [
                [
                    'operator' => 'less',
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

        $result = StrategyConfigValidator::validateConfig($config);
        $this->assertFalse($result);
    }
}
