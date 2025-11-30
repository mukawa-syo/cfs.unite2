<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectKindsTable extends Migration
{
    public function up()
    {
        Schema::create('project_kinds', function (Blueprint $table) {
            $table->increments('project_kind_id');
            $table->string('project_kind_name', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_kinds');
    }
}
