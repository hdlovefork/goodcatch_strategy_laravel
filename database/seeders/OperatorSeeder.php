<?php

namespace Database\Seeders;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('operators')->delete();
        \DB::table('operators')->insert([
            [
                'id' => 1,
                'name' => '=',
                'display' => '等于',
                'type' => 0,
                'format' => '等于 %s',
            ],
            [
                'id' => 2,
                'name' => '!=',
                'display' => '不等于',
                'type' => 0,
                'format' => '不等于 %s',
            ],
            [
                'id' => 3,
                'name' => '>',
                'display' => '大于',
                'type' => 0,
                'format' => '大于 %s',
            ],
            [
                'id' => 4,
                'name' => '>=',
                'display' => '大于等于',
                'type' => 0,
                'format' => '大于等于 %s',
            ],
            [
                'id' => 5,
                'name' => '<',
                'display' => '小于',
                'type' => 0,
                'format' => '小于 %s',
            ],
            [
                'id' => 6,
                'name' => '<=',
                'display' => '小于等于',
                'type' => 0,
                'format' => '小于等于 %s',
            ],
            [
                'id' => 7,
                'name' => 'in',
                'display' => '包含',
                'type' => 0,
                'format' => '包含 %s',
            ],
            [
                'id' => 8,
                'name' => 'not in',
                'display' => '不包含',
                'type' => 0,
                'format' => '不包含 %s',
            ],
            [
                'id' => 9,
                'name' => 'between',
                'display' => '在...之间',
                'type' => 0,
                'format' => '在 %s 之间',
            ],
            [
                'id' => 10,
                'name' => 'not between',
                'display' => '不在...之间',
                'type' => 0,
                'format' => '不在 %s 之间',
            ],
            [
                'id' => 11,
                'name' => 'and',
                'display' => '且',
                'type' => 1,
                'format' => '满足所有条件',
            ],
            [
                'id' => 12,
                'name' => 'or',
                'display' => '或',
                'type' => 1,
                'format' => '满足任意条件',
            ],
            [
                'id' => 13,
                'name' => 'not',
                'display' => '非',
                'type' => 1,
                'format' => '不满足任意条件',
            ],
        ]);
    }
}
