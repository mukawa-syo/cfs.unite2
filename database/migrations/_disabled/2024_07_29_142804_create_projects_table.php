<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('project_name', 100);
            $table->text('description');
            $table->decimal('target_pledge_amount', 10, 2);
            $table->decimal('total_pledge_amount', 10, 2)->default(0);
            $table->integer('total_backers')->default(0);
            $table->date('deadline');
            $table->string('project_type', 50);
            $table->string('initiator_name', 100);
            $table->text('project_image')->nullable();
            $table->unsignedBigInteger('project_category_id');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('project_category_id')
                ->references('project_category_id')
                ->on('project_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
