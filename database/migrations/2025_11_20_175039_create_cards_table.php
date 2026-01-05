<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول البطاقات عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول cards
        Schema::create('cards', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل بطاقة
            $table->string('card_number')->unique(); // رقم البطاقة ويجب أن يكون فريداً
            $table->boolean('used')->default(false); // هل تم استخدام البطاقة؟ افتراضي لا
            $table->foreignId('card_category_id')->constrained('card_categories')->onDelete('cascade');
            // ربط البطاقة بفئة البطاقة، وحذف البطاقة تلقائياً إذا تم حذف الفئة
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول البطاقات
     */
    public function down(): void
    {
        Schema::dropIfExists('cards'); // حذف الجدول عند التراجع
    }
};
