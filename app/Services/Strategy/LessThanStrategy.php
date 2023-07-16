<?php

namespace App\Services\Strategy;

class LessThanStrategy implements StrategyInterface {
    private $field;
    private $value;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function isSatisfied(mixed $data): bool
    {
        if(!isset($data[$this->field]))
            throw new StrategyException("less than strategy field:{$this->field} not found，data:".json_encode($data));
        return $data[$this->field] < $this->value;
    }
}