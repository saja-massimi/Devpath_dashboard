<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_contents', function (Blueprint $table) {

            $table->id('courseContent_id');
            $table->string('title');
            $table->foreignId('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('file_url')->nullable();
            $table->integer('duration')->nullable();
            $table->enum('content_type', ['video', 'quiz', 'coding']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
