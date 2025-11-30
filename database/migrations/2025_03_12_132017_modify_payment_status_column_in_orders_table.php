<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
      Schema::table('orders', function (Blueprint $table) {
          $table->smallInteger('payment_status')->change(); // tinyInteger() → smallInteger()
      });
  }

  public function down()
  {
      Schema::table('orders', function (Blueprint $table) {
          $table->string('payment_status')->default('pending')->change(); // もとのデータ型に戻す
      });
  }

};
