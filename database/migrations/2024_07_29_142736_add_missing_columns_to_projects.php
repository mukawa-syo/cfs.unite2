<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'total_backers')) {
                $table->unsignedInteger('total_backers')->default(0)->after('total_pledge_amount');
            }
            if (!Schema::hasColumn('projects', 'total_pledge_amount')) {
                $table->unsignedInteger('total_pledge_amount')->default(0)->after('goal_amount');
            }
            // 他に必要なカラムがあればここで追加
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'total_backers')) {
                $table->dropColumn('total_backers');
            }
            if (Schema::hasColumn('projects', 'total_pledge_amount')) {
                $table->dropColumn('total_pledge_amount');
            }
        });
    }
};
