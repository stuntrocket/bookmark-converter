<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Create foreign key constraint to self-referential topic_id
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
