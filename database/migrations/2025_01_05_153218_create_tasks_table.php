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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('assigned_to');
            $table->date('due_date');
            $table->enum('status', ['pending', 'in_progress', 'done']);
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

             // Definisi foreign key
             $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
             $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
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
