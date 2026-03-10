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
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->string('subject');
    $table->text('description')->nullable();
    $table->string('github_link')->nullable();
    $table->string('file_path')->nullable();
    $table->boolean('tz_status')->default(false);
    $table->boolean('report_status')->default(false);
    $table->boolean('diary_status')->default(false);
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->integer('hours_spent')->nullable();
    $table->timestamps();
});;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};