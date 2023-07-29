<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('condition_strategy', function (Blueprint $table) {
            $table->id();
            $table->integer('strategy_id')->comment('策略ID');
            $table->integer('condition_id')->comment('条件ID');
            $table->integer('condition_type')->comment('条件类型');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_strategy');
    }
};
