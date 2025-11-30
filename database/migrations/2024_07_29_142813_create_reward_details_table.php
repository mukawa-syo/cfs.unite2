<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('reward_details', function (Blueprint $table) {
            $table->increments('reward_detail_id');
            $table->string('color', 50);
            $table->string('size', 50);
            $table->text('reward_detail_image')->nullable();
            $table->unsignedBigInteger('reward_id');
            $table->foreign('reward_id')->references('reward_id')->on('rewards');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reward_details');
    }
}
