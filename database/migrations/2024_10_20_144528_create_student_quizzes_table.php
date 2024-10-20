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
        Schema::create('student_quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key for students
            $table->unsignedBigInteger('quiz_id'); // Foreign key for quizzes
            $table->integer('score'); // Score achieved by the student
            $table->integer('total_questions'); // Total questions in the quiz
            $table->integer('time_taken'); // Time taken to complete the quiz (in seconds)
            $table->enum('status', ['passed', 'failed']); // Status of the quiz
            $table->string('remarks')->nullable(); // Remarks regarding the quiz
            $table->json('quiz_data');
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quizzes');
    }
};
