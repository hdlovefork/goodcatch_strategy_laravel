<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }
}
