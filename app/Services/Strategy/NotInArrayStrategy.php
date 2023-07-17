<?php

namespace App\Services\Strategy;

class NotInArrayStrategy extends InArrayStrategy
{
    public function isSatisfied(mixed $data): bool
    {
        return !parent::isSatisfied($data);
    }
}
