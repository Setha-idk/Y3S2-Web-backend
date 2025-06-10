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
        //for storing steps of each tasks
        //each task can have multiple steps
        Schema::create('steps', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->string('name');//step name
            $table->text('description')->nullable();//step description
            $table->enum('status', [ 'in_progress', 'completed'])->default('in_progress');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
