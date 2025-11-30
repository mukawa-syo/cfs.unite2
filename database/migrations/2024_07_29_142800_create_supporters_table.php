<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportersTable extends Migration
{
    public function up()
    {
        Schema::create('supporters', function (Blueprint $table) {
            $table->increments('supporter_id');
            $table->string('supporter_name', 50);
            $table->string('address', 255);
            $table->string('password', 255);
            $table->timestamps();
        });

        // 既存のprojectsテーブルからtotal_pledge_amount, total_backersカラムを削除
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['total_pledge_amount', 'total_backers']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('supporters');
    }
}
