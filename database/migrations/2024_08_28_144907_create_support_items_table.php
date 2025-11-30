<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('support_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // bigint 型に変更
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            // 外部キー制約を projects.id に変更
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('support_items');
    }
};
