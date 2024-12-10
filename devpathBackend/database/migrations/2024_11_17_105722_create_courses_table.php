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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_title');
            $table->text('course_description');
            $table->decimal('course_price', 8, 2);
            $table->integer('course_duration');
            $table->string('course_image');
            $table->string('category');
            $table->enum('diffculty_leve', ['beginner', 'intermediate', 'advanced']);
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_deleted')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
