<?php
// database/migrations/xxxx_xx_xx_xxxxxx_change_payment_status_type_in_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePaymentStatusTypeInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('payment_status')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->change(); // 元が文字列だった場合の戻し
        });
    }
}
