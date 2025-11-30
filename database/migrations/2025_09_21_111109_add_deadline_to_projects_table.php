<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('projects', function (Illuminate\Database\Schema\Blueprint $table) {
        // 既存環境との互換を考えて nullable にしておく
        if (!Schema::hasColumn('projects', 'deadline')) {
            $table->date('deadline')->nullable()->after('status');
        }
    });
}

public function down(): void
{
    Schema::table('projects', function (Illuminate\Database\Schema\Blueprint $table) {
        if (Schema::hasColumn('projects', 'deadline')) {
            $table->dropColumn('deadline');
        }
    });
}
};
