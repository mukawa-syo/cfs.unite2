<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id('reward_id');
            $table->string('reward_name', 100);
            $table->decimal('price_incl_tax', 10, 2);
            $table->text('reward_description');
            $table->text('reward_image')->nullable();
            $table->date('delivery_schedule');
            $table->unsignedBigInteger('project_id');

            // 外部キー制約を修正
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
