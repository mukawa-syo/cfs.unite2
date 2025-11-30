<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnullableに変更
            $table->unsignedInteger('reward_detail_id')->nullable()->change();
            
            // 外部キー制約を再追加（nullable）
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};

     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};

     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};

     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};

     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};

     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を一時的に削除
            $table->dropForeign(['reward_detail_id']);
            
            // カラムをnot nullに戻す
            $table->unsignedInteger('reward_detail_id')->nullable(false)->change();
            
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details');
        });
    }
};
