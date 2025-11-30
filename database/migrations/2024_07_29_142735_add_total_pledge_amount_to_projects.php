<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('projects', 'total_pledge_amount')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->unsignedInteger('total_pledge_amount')->default(0)->after('goal_amount');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'total_pledge_amount')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('total_pledge_amount');
            });
        }
    }
};
