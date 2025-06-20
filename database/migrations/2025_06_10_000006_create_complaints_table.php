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
        // For storing complaints against users
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('target_person_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->string('type'); // Complaint type (e.g., harassment, misconduct)
            $table->string('subject'); // Complaint subject
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
