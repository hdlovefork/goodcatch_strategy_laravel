<?php

namespace Tests;

use App\Models\Condition;
use Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * 条件的显示测试
 */
class ConditionHumanizedTest extends TestCase
{
    use DatabaseMigrations, TestDataMigration;

    /**
     * 等于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function equal_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 1,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 等于 18岁', $condition->refresh()->display);
    }

    /**
     * 不等于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function not_equal_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 2,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 不等于 18岁', $condition->refresh()->display);
    }

    /**
     * 大于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function greater_than_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 3,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 大于 18岁', $condition->refresh()->display);
    }

    /**
     * 大于等于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function greater_than_or_equal_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 4,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 大于等于 18岁', $condition->refresh()->display);
    }

    /**
     * 小于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function less_than_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 5,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 小于 18岁', $condition->refresh()->display);
    }

    /**
     * 小于等于条件显示的值应该是中文语义化之后的
     * @test
     */
    public function less_than_or_equal_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 6,
            'value' => '18',
        ]);
        $this->assertEquals('用户年龄 小于等于 18岁', $condition->refresh()->display);
    }

    /**
     * 包含条件显示的值应该是中文语义化之后的
     * @test
     */
    public function contain_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 2,
            'operator_id' => 7,
            'value' => '北京,上海,广州',
        ]);
        $this->assertEquals('用户所在城市 包含 北京,上海,广州', $condition->refresh()->display);
    }

    /**
     * 不包含条件显示的值应该是中文语义化之后的
     * @test
     */
    public function not_contain_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 2,
            'operator_id' => 8,
            'value' => '北京,上海,广州',
        ]);
        $this->assertEquals('用户所在城市 不包含 北京,上海,广州', $condition->refresh()->display);
    }

    /**
     * 在...之间条件显示的值应该是中文语义化之后的
     * @test
     */
    public function between_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 9,
            'value' => '18,30',
        ]);
        $this->assertEquals('用户年龄 在 18岁,30岁 之间', $condition->refresh()->display);
    }

    /**
     * 不在...之间条件显示的值应该是中文语义化之后的
     * @test
     */
    public function not_between_condition_display_should_be_humanized()
    {
        $condition = Condition::factory()->create([
            'field_id' => 1,
            'operator_id' => 10,
            'value' => '18,30',
        ]);
        $this->assertEquals('用户年龄 不在 18岁,30岁 之间', $condition->refresh()->display);
    }
}
