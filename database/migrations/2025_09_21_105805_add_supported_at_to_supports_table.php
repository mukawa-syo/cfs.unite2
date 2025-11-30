<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('supports', function (Blueprint $table) {
            $table->timestamp('supported_at')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('supports', function (Blueprint $table) {
            $table->dropColumn('supported_at');
        });
    }
};
