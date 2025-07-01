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
        Schema::table('brands', function (Blueprint $table) {
            $table->foreignId('brand_level_id')->nullable()->after('country_id')->constrained('brand_levels')->onDelete('set null');
            $table->foreignId('owner_id')->nullable()->after('brand_level_id')->constrained('users')->onDelete('set null');
            $table->index('brand_level_id');
            $table->index('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropForeign(['brand_level_id']);
            $table->dropForeign(['owner_id']);
            $table->dropIndex(['brand_level_id']);
            $table->dropIndex(['owner_id']);
            $table->dropColumn(['brand_level_id', 'owner_id']);
        });
    }
};
