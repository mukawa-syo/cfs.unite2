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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->after('amount');
            $table->unsignedBigInteger('reward_id')->nullable()->after('project_id');
            
            // 外部キー制約を追加
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('reward_id')->references('reward_id')->on('rewards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['reward_id']);
            $table->dropColumn(['project_id', 'reward_id']);
        });
    }
};