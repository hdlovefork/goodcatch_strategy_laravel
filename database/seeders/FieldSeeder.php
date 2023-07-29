<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('fields')->delete();
        // 添加年龄字段和操作符
        $field = Field::factory()->create([
            'id' => 1,
            'name' => 'age',
            'display' => '用户年龄',
            'unit' => '岁',
        ]);
        $field->operators()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        // 添加城市字段和操作符
        $field = Field::factory()->create([
            'id' => 2,
            'name' => 'city',
            'display' => '用户所在城市',
            'unit' => '',
        ]);
        $field->operators()->attach([1, 2, 7, 8]);

        // 添加电子邮箱字段和操作符
        $field = Field::factory()->create([
            'id' => 3,
            'name' => 'email',
            'display' => '电子邮箱',
            'unit' => '',
        ]);
        $field->operators()->attach([1, 2, 7, 8]);

        // 添加性别字段和操作符
        // 添加电子邮箱字段和操作符
        $field = Field::factory()->create([
            'id' => 4,
            'name' => 'gender',
            'display' => '性别',
            'unit' => '',
        ]);
        $field->operators()->attach([1, 7]);
    }
}
