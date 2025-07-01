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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام دسته
            $table->string('slug')->unique(); // slug برای URL
            $table->text('description')->nullable(); // توضیحات
            $table->string('icon')->nullable(); // آیکون دسته
            $table->string('color')->nullable(); // رنگ دسته
            $table->unsignedBigInteger('parent_id')->nullable(); // دسته والد
            $table->integer('sort_order')->default(0); // ترتیب نمایش
            $table->boolean('is_active')->default(true); // فعال/غیرفعال
            $table->timestamps();

            // Foreign key برای رابطه سلسله‌مراتبی
            $table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('cascade');

            // Indexes
            $table->index(['parent_id', 'sort_order']);
            $table->index('slug');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
