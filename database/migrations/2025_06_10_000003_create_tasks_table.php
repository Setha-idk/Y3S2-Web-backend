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
        //for storing tasks names and descriptions only
        //like this is use to store all the task in the organization
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');//task name
            $table->text('description')->nullable();//task description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
