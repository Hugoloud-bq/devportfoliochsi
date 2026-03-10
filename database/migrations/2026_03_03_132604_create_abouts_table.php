<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('title');
    $table->text('bio')->nullable();
    $table->string('email')->nullable();
    $table->string('github')->nullable();
    $table->string('telegram')->nullable();
    $table->string('avatar')->nullable();
    $table->json('skills')->nullable();
    $table->string('university');
    $table->string('specialty');
    $table->integer('course');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};