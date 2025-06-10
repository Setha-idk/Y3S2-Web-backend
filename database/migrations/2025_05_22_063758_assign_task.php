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
        //for assigning tasks to employees
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');// Foreign key to tasks table
            $table->date('due_date')->default(now()->addDays(7)); // Default due date is 7 days from now
            $table->date("submitted_date")->nullable(); // Date when the task was submitted
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade'); // The user assigned to the task
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade'); // The user who assigned the task
            $table->timestamps();//time of assigning the task
            $table->string('file_path')->nullable(); // Optional file path for task-related documents
            $table->string('submitted_file_path')->nullable(); // Optional file path for submitted task documents
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_assignments');
    }
};
