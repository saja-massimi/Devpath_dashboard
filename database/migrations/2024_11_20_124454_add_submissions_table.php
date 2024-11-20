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
        Schema::create('submissions', function (Blueprint $table) {

            $table->id('submission_id');
            $table->string('submission_title');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('content_id')->references('courseContent_id')->on('course_contents')->onDelete('cascade');
            $table->string('submission_file');
            $table->string('sfeedback')->nullable();
            $table->string('submission_code');
            $table->enum('submission_status', ['pending', 'checked'])->default('pending');
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
