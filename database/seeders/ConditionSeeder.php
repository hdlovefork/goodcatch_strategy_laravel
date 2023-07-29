<?php

namespace Database\Seeders;

use App\Models\Condition;
use App\Models\Field;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("conditions")->delete();

    }
}
