<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('majorcategories', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主鍵
            $table->string('name'); // 分類名稱
            $table->timestamp('createTime')->nullable(); // 自定建立時間
            $table->timestamp('updateTime')->nullable(); // 自定更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majorcategory');
    }
};
