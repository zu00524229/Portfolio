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
        Schema::create('majors', function (Blueprint $table) {
            $table->id(); // 主鍵 id
            $table->unsignedBigInteger('majorId'); // 關聯 MajorCategory 的 id
            $table->string('name')->nullable(); // 專業名稱
            $table->string('photo')->nullable(); // 照片路徑
            $table->text('content')->nullable(); // 說明內容
            $table->timestamp('createTime')->nullable(); // 建立時間
            $table->timestamp('updateTime')->nullable(); // 更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
