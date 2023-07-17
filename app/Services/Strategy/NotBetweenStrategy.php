<?php

namespace App\Services\Strategy;

class NotBetweenStrategy extends BetweenStrategy
{
    public function isSatisfied(mixed $data): bool
    {
        return !parent::isSatisfied($data);
    }
}
