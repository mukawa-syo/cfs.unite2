<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdColumnToProjectsTable extends Migration
{
  public function up()
  {
      Schema::table('projects', function (Blueprint $table) {
          // この部分を削除またはコメントアウト
          // $table->bigIncrements('id')->first();
      });
  }

  public function down()
  {
      Schema::table('projects', function (Blueprint $table) {
          // $table->dropColumn('id'); // これをコメントアウトまたは削除します
      });
  }
}
