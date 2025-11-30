<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');                      // プロジェクト名
            $table->text('description')->nullable();      // 説明
            $table->unsignedInteger('goal_amount')->default(0); // 目標金額
            $table->string('status')->default('draft');   // 状態 draft/published/closed など
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
