<?php

namespace App\Services\Strategy;

class LessThanOrEqualToStrategy implements StrategyInterface {
    private $field;
    private $value;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function isSatisfied(mixed $data): bool
    {
        if(!isset($data[$this->field]))
            throw new StrategyException("less than or equal to strategy field:{$this->field} not found，data:".json_encode($data));
        return $data[$this->field] <= $this->value;
    }
}
