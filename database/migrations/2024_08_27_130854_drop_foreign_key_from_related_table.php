<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
      Schema::table('related_table', function (Blueprint $table) {
          // $table->dropForeign(['project_id']); // これをコメントアウトまたは削除
          // 他の操作があれば、それはそのまま残してください
      });
  }

  public function down()
  {
      Schema::table('related_table', function (Blueprint $table) {
          // 必要に応じて、元に戻す処理をここに追加します
      });
  }
};
