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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("name");                     // 姓名
            $table->string("nickName")->nullable();     // 暱稱
            $table->string("account")->unique();        // 帳號
            $table->string("password");                 // 密碼
            $table->string("telephone")->nullable();    // 手機
            $table->string("address")->nullable();      // 住址
            $table->string("gender")->nullable();       // 性別
            $table->string("email")->nullable();        // 信箱
            $table->date("birthdate")->nullable();      // 生日
            $table->timestamp("createTime")->nullable();
            $table->timestamp("updateTime")->nullable();
            $table->string("role")->default('player'); // 用來判斷是否顯示後台專區
            $table->timestamps(); // Laravel 用來記錄 created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player');
    }
};
