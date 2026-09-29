<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['avatar', 'accessory', 'frame']);
            $table->string('icon');
            $table->integer('price');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('child_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_item_id')->constrained()->onDelete('cascade');
            $table->timestamp('purchased_at')->useCurrent();
            $table->unique(['child_profile_id', 'store_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_items');
        Schema::dropIfExists('store_items');
    }
};
