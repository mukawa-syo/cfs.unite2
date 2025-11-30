<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDreamersTable extends Migration
{
    public function up()
    {
        Schema::create('dreamers', function (Blueprint $table) {
            $table->increments('dreamer_id');
            $table->string('company_name', 100);
            $table->string('contact_last_name', 50);
            $table->string('contact_first_name', 50);
            $table->string('representative_last_name', 50);
            $table->string('representative_first_name', 50);
            $table->string('postal_code', 10);
            $table->string('address', 255);
            $table->string('phone_number', 15);
            $table->string('email', 100);
            $table->text('consultation_details')->nullable();
            $table->boolean('terms_agreement');
            $table->string('stripe_initiator_id', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dreamers');
    }
}
