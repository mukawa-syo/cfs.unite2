<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['total_pledge_amount', 'total_backers']);
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('total_pledge_amount', 10, 2)->default(0);
            $table->integer('total_backers')->default(0);
        });
    }
}; 