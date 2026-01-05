<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول المواعيد عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول المواعيد
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // معرف الموعد تلقائي
            $table->integer('doctorId'); // معرف الطبيب المرتبط بالموعد
            $table->string('day'); // اليوم (مثلاً: 'Monday' أو '2025-12-18' حسب تصميمك)
            $table->time('from_time'); // وقت بداية الموعد
            $table->time('to_time'); // وقت نهاية الموعد
            $table->enum('status', ['open', 'closed'])->default('closed');
            // حالة الموعد: مفتوح للحجز أو مغلق (افتراضي مغلق)
            $table->decimal('price', 8, 2)->default(0); // سعر الموعد مع رقم عشري و افتراضي 0
            $table->integer('max_bookings')->default(1);
            // أقصى عدد للحجوزات في هذا الموعد
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول المواعيد
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments'); // حذف الجدول عند التراجع
    }
};
