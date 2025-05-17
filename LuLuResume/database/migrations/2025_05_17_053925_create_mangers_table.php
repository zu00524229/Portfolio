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
        Schema::create('managers', function (Blueprint $table) {
            $table->bigIncrements('Id'); // 自訂主鍵名稱
            $table->string('name');
            $table->string('account')->unique(); // 登入帳號通常設為唯一
            $table->string('password');
            $table->timestamp('createTime')->nullable();
            $table->timestamp('updateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangers');
    }
};
