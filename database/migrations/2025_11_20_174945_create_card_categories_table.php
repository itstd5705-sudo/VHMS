<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول فئات البطاقات عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول card_categories
        Schema::create('card_categories', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل فئة بطاقة
            $table->integer('price'); // سعر الفئة
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول فئات البطاقات
     */
    public function down(): void
    {
        Schema::dropIfExists('card_categories'); // حذف الجدول عند التراجع
    }
};
