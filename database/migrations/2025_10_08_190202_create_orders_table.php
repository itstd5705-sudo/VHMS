<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول الطلبات عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل طلب
            $table->integer('userId'); // معرف المستخدم الذي قام بالطلب
            $table->string('phoneNumber')->nullable(); // رقم الهاتف للطلب، يمكن أن يكون فارغ
            $table->string('location'); // موقع التوصيل أو العنوان
            $table->double('total')->default(0); // المجموع الكلي للطلب، افتراضي 0
            $table->text('note')->nullable(); // ملاحظات إضافية للطلب، يمكن أن تكون فارغة
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول الطلبات
     */
    public function down(): void
    {
        Schema::dropIfExists('orders'); // حذف الجدول عند التراجع
    }
};
