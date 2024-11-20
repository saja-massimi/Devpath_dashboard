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
        Schema::create('courseCategory', function (Blueprint $table) {
            $table->id('courseCategoryId');
            $table->foreignId('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->foreignId('category_id')->references('category_id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_category');
    }
};
