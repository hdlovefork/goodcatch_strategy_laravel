<?php

namespace App\Models;

use App\Exceptions\OperatorException;
use App\Services\Contract\Chain;
use Goodcatch\Strategy\StrategyValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Strategy extends Model implements Chain
{
    use HasFactory;

    protected static $allFields = [];
    protected static $allOperators = [];

    public static function createCondition($conditionValue, $fieldName, $operatorName): Condition
    {
        if (empty(static::$allFields)) {
            static::$allFields = Field::all()->pluck('id', 'name');
        }
        if (empty(static::$allOperators)) {
            static::$allOperators = Operator::all()->pluck('id', 'name');
        }
        if (!isset(static::$allFields[$fieldName])) {
            throw new OperatorException('field not found');
        }
        if (!isset(static::$allOperators[$operatorName])) {
            throw new OperatorException('operator not found');
        }

        $condition = new Condition();
        $condition->value = $conditionValue;
        $condition->field_id = static::$allFields[$fieldName];
        $condition->operator_id = static::$allOperators[$operatorName];
        $condition->save();
        return $condition;
    }

    /**
     * 在给定的策略中创建简单条件
     * @param $strategy
     * @param $conditionValue
     * @param $fieldId
     * @param $operatorId
     * @return Condition
     * @throws OperatorException
     */
    public static function createConditionWith($strategy, $conditionType, $conditionValue, $fieldName, $operatorName): Condition
    {
        $condition = static::createCondition($conditionValue, $fieldName, $operatorName);
        $strategy->attachCondition($condition, $conditionType);
        return $condition;
    }

    /**
     * 设置策略的运算符
     */
    public function setOperator($operatorName): void
    {
        $opt = Operator::where('name', $operatorName)->first();
        $this->operator_id = $opt->id;
    }

    /**
     * 在给定的策略中添加条件
     */
    public function attachCondition($condition, $conditionType): void
    {
        $this->conditions()->attach($condition, ['condition_type' => $conditionType]);
    }

    private static function _createWithRule(array $rules, $root = true)
    {
        // 创建策略
        $strategy = new Strategy();
        $operator = $rules['operator'] ?? 'and';
        if ($root && !isset($rules['conditions'])) {
            // 简单条件的根策略默认为and
            $operator = 'and';
        }
        $strategy->setOperator($operator);
        $strategy->save();

        // 简单条件
        if (!isset($rules['conditions'])) {
            if ($root) {
                $child = static::createCondition($rules['value'], $rules['field'], $rules['operator']);
                $strategy->attachCondition($child, Condition::TYPE_CONDITION);
                return $strategy;
            }
            return static::createCondition($rules['value'], $rules['field'], $rules['operator']);
        }

        // 复杂条件
        $conditions = $rules['conditions'];
        foreach ($conditions as $condition) {
            if (isset($condition['operator']) && isset($condition['conditions'])) {
                $child = static::createWithRule($condition, false);
                $strategy->attachCondition($child, Condition::TYPE_STRATEGY);
            } else {
                $child = static::createCondition($condition['value'], $condition['field'], $condition['operator']);
                $strategy->attachCondition($child, Condition::TYPE_CONDITION);
            }
        }
        return $strategy;
    }

    /**
     * 根据简单或复杂条件创建策略
     * @param array $rules
     * @throws OperatorException
     */
    public static function createWithRule(array $rules)
    {
        return static::_createWithRule($rules);
    }

    protected static function booted()
    {
        parent::booted();
        static::saving(function ($model) {
            if (empty($model->display)) {
                if ($model->operator && $model->operator->type === Operator::TYPE_LOGIC) {
                    // 如果是逻辑运算符，直接显示运算符的display
                    $model->display = $model->operator->display;
                } else {
                    $model->display = '';
                }
            }
            if (empty($model->name)) {
                $model->name = '默认策略';
            }
        });
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function conditions()
    {
        return $this->belongsToMany(Condition::class)->where('condition_type', Condition::TYPE_CONDITION);
    }

    public function strategies()
    {
        return $this->belongsToMany(Strategy::class, $this->conditions()->getTable(), 'strategy_id', 'condition_id')->where('condition_type', Condition::TYPE_STRATEGY);
    }

    public function handle(mixed $payload, $next)
    {
    }

    public function toRule()
    {
        return $this->_toRule();
    }

    protected function _toRule($root = true)
    {
        // 如果当前策略下只有一个条件，则是简单规则
        if ($root) {
            if ($this->strategies()->count() == 0 && $this->conditions()->count() == 1) {
                $condition = $this->conditions->first();
                return $condition->toRule();
            }
        }
        $rule['operator'] = $this->operator->name;
        $rule['conditions'] = [];
        foreach ($this->conditions as $condition) {
            $rule['conditions'][] = $condition->toRule();
        }
        foreach ($this->strategies as $strategy) {
            $rule['conditions'][] = $strategy->_toRule(false);
        }
        return $rule;
    }
}
