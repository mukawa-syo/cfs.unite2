<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->timestamp('order_date')->useCurrent();
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name_kana', 50);
            $table->string('first_name_kana', 50);
            $table->string('phone_number', 15);
            $table->string('email', 100);
            $table->string('postal_code', 10);
            $table->string('prefecture', 50);
            $table->string('city', 50);
            $table->string('address', 100);
            $table->string('building_name', 100)->nullable();
            $table->boolean('terms_agreement');
            $table->boolean('payment_status')->default(false);
            $table->string('charge_id', 50)->nullable();
            $table->string('session_id', 50)->nullable();
            $table->unsignedInteger('reward_detail_id');
            $table->unsignedInteger('supporter_id');
            $table->foreign('reward_detail_id')->references('reward_detail_id')->on('reward_details');
            $table->foreign('supporter_id')->references('supporter_id')->on('supporters');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
