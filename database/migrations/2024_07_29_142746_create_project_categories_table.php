<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('project_categories', function (Blueprint $table) {
            $table->bigIncrements('project_category_id');
            $table->string('category_name', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_categories');
    }
}
