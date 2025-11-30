<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'project_category_id')) {
                $table->unsignedBigInteger('project_category_id')->nullable()->after('status');
                $table->foreign('project_category_id')
                      ->references('project_category_id')
                      ->on('project_categories')
                      ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'project_category_id')) {
                $table->dropForeign(['project_category_id']);
                $table->dropColumn('project_category_id');
            }
        });
    }
};
