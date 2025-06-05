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
        //use to store the history of task and step changes
        schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->timestamp('action_time')->useCurrent(); // The time when the action was performed
            $table->string("user_name");//name of the person who changed the task, e.g., 'John Doe', 'Jane Smith', etc
            $table->string("email"); // Email of the person who changed the task, e.g., 'john@example.com'
            $table->string("name"); // Name of the task or step that was changed, e.g., 'task 1', 'task 2', etc
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade'); // The user who performed the action
            $table->string('action'); // e.g., 'created', 'updated', 'deleted'
            $table->text('description')->nullable(); // Additional details about the action
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
