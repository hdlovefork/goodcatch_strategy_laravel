<?php

namespace Tests;

use App\Models\Operator;
use App\Models\Strategy;
use Laravel\Lumen\Testing\DatabaseMigrations;

class StrategyHumanizedTest extends TestCase
{
    use DatabaseMigrations, TestDataMigration;

    /**
     * and条件显示的值应该是中文语义化之后的
     * @test
     */
    public function and_strategy_display_should_be_humanized()
    {
        $and = Operator::query()->where('name', 'and')->first();
        $strategy = Strategy::factory()->create([
            'name' => $and->name,
            'operator_id' => $and->id,
        ]);
        $this->assertEquals($and->display, $strategy->refresh()->display);
    }

    /**
     * or条件显示的值应该是中文语义化之后的
     * @test
     */
    public function or_strategy_display_should_be_humanized()
    {
        $or = Operator::query()->where('name', 'or')->first();
        $strategy = Strategy::factory()->create([
            'name' => $or->name,
            'operator_id' => $or->id,
        ]);
        $this->assertEquals($or->display, $strategy->refresh()->display);
    }

    /**
     * not条件显示的值应该是中文语义化之后的
     * @test
     */
    public function not_strategy_display_should_be_humanized()
    {
        $not = Operator::query()->where('name', 'not')->first();
        $strategy = Strategy::factory()->create([
            'name' => $not->name,
            'operator_id' => $not->id,
        ]);
        $this->assertEquals($not->display, $strategy->refresh()->display);
    }
}
