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
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('操作符号');
            $table->string('display')->comment('操作符中文语义名称');
            $table->string('format')->comment('操作符格式化字符串，支持sprintf格式化');
            $table->tinyInteger('type')->comment('比较：0，逻辑：1')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};
