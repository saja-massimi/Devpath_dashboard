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
        Schema::create('Copouns', function (Blueprint $table) {
            $table->id('copoun_id');
            $table->string('copoun_code', 50)->unique();
            $table->foreignId('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->decimal('discount', 5, 2);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
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
