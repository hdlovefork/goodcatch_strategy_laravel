# 智能策略的Laravel实现

## 概述

基于[goodcatch_strategy](https://github.com/hdlovefork/goodcatch_strategy)项目策略的Laravel实现，包含数据库定义、模型以及策略间的转换。

## 使用

根据一个简单规则创建策略

```php
use App\Models\Strategy;

$strategy = Strategy::createWithRule([
            'operator' => 'between',
            'field' => 'age',
            'value' => '18,30'
        ]);
```

根据一个复杂规则创建策略

```php
use App\Models\Strategy;

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
```

也可以将数据库对应的策略模型转换成规则数组

```php
use App\Models\Strategy;

$strategy = Strategy::find(1);
$rule = $strategy->toRule();
```
