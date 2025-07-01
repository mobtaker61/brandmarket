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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام برند
            $table->string('company_name'); // شرکت اصلی صاحب برند
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict'); // کشور
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('logo')->nullable();
            $table->enum('brand_status', ['active', 'inactive', 'pending'])->default('active'); // وضعیت برند
            $table->enum('iran_market_presence', ['official', 'unofficial', 'absent'])->default('absent'); // حضور در بازار ایران
            $table->boolean('is_active')->default(true); // فعال یا غیرفعال
            $table->text('notes')->nullable(); // یادداشت
            $table->timestamps();

            $table->index(['name', 'company_name']);
            $table->index('brand_status');
            $table->index('iran_market_presence');
            $table->index('is_active');
            $table->index('country_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
