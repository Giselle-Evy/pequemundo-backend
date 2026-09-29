<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('child_profiles', function (Blueprint $table) {
            $table->foreignId('equipped_avatar_id')
                ->nullable()
                ->after('avatar')
                ->constrained('store_items')
                ->nullOnDelete();

            $table->foreignId('equipped_accessory_id')
                ->nullable()
                ->after('equipped_avatar_id')
                ->constrained('store_items')
                ->nullOnDelete();

            $table->foreignId('equipped_accessory_id_2')
                ->nullable()
                ->after('equipped_accessory_id')
                ->constrained('store_items')
                ->nullOnDelete();

            $table->foreignId('equipped_frame_id')
                ->nullable()
                ->after('equipped_accessory_id_2')
                ->constrained('store_items')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('child_profiles', function (Blueprint $table) {
            $table->dropForeign(['equipped_avatar_id']);
            $table->dropForeign(['equipped_accessory_id']);
            $table->dropForeign(['equipped_accessory_id_2']);
            $table->dropForeign(['equipped_frame_id']);
            $table->dropColumn([
                'equipped_avatar_id',
                'equipped_accessory_id',
                'equipped_accessory_id_2',
                'equipped_frame_id',
            ]);
        });
    }
};