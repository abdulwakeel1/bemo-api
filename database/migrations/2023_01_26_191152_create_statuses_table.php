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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('title', 50);
            $table->integer('sort_order')->nullable();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onUpdate('cascade')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('statuses');
    }
};
