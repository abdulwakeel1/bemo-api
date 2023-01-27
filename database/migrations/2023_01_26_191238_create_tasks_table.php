<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->integer('story_points')->nullable();
            $table->boolean('is_flaged')->nullable();
            $table->integer('sort_order')->nullable();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('assignee_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('assigned_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('column_id')->constrained('statuses')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->index('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
