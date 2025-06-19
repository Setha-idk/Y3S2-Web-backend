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
        // This table will store information about different roles in different departments in the organization.
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // name for the role
            $table->string('description')->nullable(); // optional description for the role
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade'); // foreign key to departments table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
