<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Condition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConditionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Condition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        ];
    }
}
