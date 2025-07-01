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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام نوع کاربر (مثل admin, staff, user)
            $table->string('display_name'); // نام نمایشی (مثل مدیر، کارمند، کاربر)
            $table->text('description')->nullable(); // توضیحات
            $table->string('color', 7)->default('#6B7280'); // رنگ (hex code)
            $table->string('icon')->nullable(); // آیکون (class name)
            $table->integer('sort_order')->default(0); // ترتیب نمایش
            $table->boolean('is_active')->default(true); // فعال یا غیرفعال
            $table->timestamps();

            $table->unique('name');
            $table->index('sort_order');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
