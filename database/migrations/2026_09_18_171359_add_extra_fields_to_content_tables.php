<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Campos extra para subjects
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->string('color')->default('#4FC3F7')->after('icon');
            $table->text('description')->nullable()->after('color');
            $table->integer('order')->default(0)->after('description');
            $table->boolean('is_active')->default(true)->after('order');
        });

        // Campos extra para exercises
        Schema::table('exercises', function (Blueprint $table) {
            $table->string('title')->after('subject_id');
            $table->text('instructions')->nullable()->after('question');
            $table->string('difficulty')->default('easy')->after('type');
            $table->string('image_url')->nullable()->after('difficulty');
            $table->integer('order')->default(0)->after('points_reward');
            $table->boolean('is_active')->default(true)->after('order');
        });

        // Campo order para options
        Schema::table('options', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('is_correct');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn(['slug', 'color', 'description', 'order', 'is_active']);
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn(['title', 'instructions', 'difficulty', 'image_url', 'order', 'is_active']);
        });

        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};