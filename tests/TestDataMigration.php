<?php

namespace Tests;

use Database\Seeders\TestDataSeeder;

trait TestDataMigration
{
    public function fillTestData()
    {
        $this->artisan('db:seed', ['class' => TestDataSeeder::class]);
    }
}
