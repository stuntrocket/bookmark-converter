<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bookmark_topic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookmark_id');
            $table->unsignedBigInteger('topic_id');
            $table->timestamps();

            $table->foreign('bookmark_id')->references('id')->on('bookmarks')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmark_topic');
        Schema::dropIfExists('bookmarks');
    }
};
