<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            // 生成一个礼拜之前的时间
            'start_at' => $this->faker->dateTimeBetween('-1 week'),
            // 生成一个礼拜之后的时间
            'end_at' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
