<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->integer('score')->default(0);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('badge_icon')->nullable();
            $table->timestamps();
        });

        Schema::create('achievement_child_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('achievement_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievement_child_profile');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('progress');
    }
};