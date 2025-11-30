<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateSupportsTable extends Migration
{
    // public function up()
    // {
    //     Schema::table('supports', function (Blueprint $table) {
    //         // 外部キー制約とカラムの存在を確認して削除
    //         if (Schema::hasColumn('supports', 'user_id')) {
    //             // 外部キーが存在するかどうかをチェック
    //             $foreignKeys = DB::select(DB::raw('SHOW KEYS FROM supports WHERE Key_name="supports_user_id_foreign"'));
    //             if (!empty($foreignKeys)) {
    //                 $table->dropForeign(['user_id']); // 外部キーの削除
    //             }
    //             $table->dropColumn('user_id'); // カラムの削除
    //         }
    //     });
    // }

    public function up()
    {
        Schema::table('supports', function (Blueprint $table) {
            // 既に存在していれば追加しない
            if (!Schema::hasColumn('supports', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
    public function down()
    {
        Schema::table('supports', function (Blueprint $table) {
            // カラムを復元（元の構造に戻す）
            $table->unsignedBigInteger('user_id')->nullable();

            // 必要に応じて外部キーを追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
