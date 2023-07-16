<?php

namespace App\Services\Strategy;

/**
 * 策略配置校验器
 */
class StrategyConfigValidator
{
    public static function validateConfig($config)
    {
        if (!isset($config['operator']) || !in_array($config['operator'], ['or', 'and'])) {
            return false;
        }

        if (!isset($config['conditions']) || !is_array($config['conditions'])) {
            return false;
        }

        foreach ($config['conditions'] as $condition) {
            if (!self::validateCondition($condition)) {
                return false;
            }
        }

        return true;
    }

    public static function validateCondition($condition)
    {
        if (isset($condition['operator']) && in_array($condition['operator'], ['or', 'and'])) {
            if (!isset($condition['conditions']) || !is_array($condition['conditions'])) {
                return false;
            }

            foreach ($condition['conditions'] as $innerCondition) {
                if (!self::validateCondition($innerCondition)) {
                    return false;
                }
            }
        } else {
            if (!isset($condition['field']) || !isset($condition['operator']) || !isset($condition['value'])) {
                return false;
            }
            if (!in_array($condition['operator'], ['>', '<', '=', '<=', '>=', 'in', 'between'])) {
                return false;
            }
        }

        return true;
    }

}
