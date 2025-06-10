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
        //This table will store information about different departments in the organization.
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // name for the department
            $table->string('description')->nullable(); // optional description for the department
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
