<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول عناصر الطلب عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول order_items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل عنصر في الطلب
            $table->integer('orderId'); // معرف الطلب المرتبط به هذا العنصر
            $table->integer('medId'); // معرف الدواء أو المنتج
            $table->integer('qty')->default(1); // كمية المنتج في هذا الطلب، افتراضي 1
            $table->decimal('price', 10, 2); // سعر العنصر (سعر الوحدة × الكمية إذا رغبت)
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول عناصر الطلب
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items'); // حذف الجدول عند التراجع
    }
};
