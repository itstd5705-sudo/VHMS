<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول الحجوزات عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول الحجوزات
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // معرف الحجز تلقائي
            $table->string('userName'); // اسم المستخدم
            $table->enum('status', ['waiting','checked_in','done','cancelled'])->default('waiting');
            // حالة الحجز: انتظار، تم تسجيل الدخول، مكتمل، ملغي
            $table->text('note')->nullable(); // ملاحظات الحجز، يمكن أن تكون فارغة
            $table->string('phone'); // رقم الهاتف
            $table->string('card_number')->nullable(); // رقم البطاقة إذا وجد، يمكن أن يكون فارغ
            $table->integer('userId'); // معرف المستخدم المرتبط بالحجز
            $table->integer('appointmentId'); // معرف الموعد المرتبط بالحجز
            $table->integer('queue_number')->nullable(); // رقم الدور أو الطابور، يمكن أن يكون فارغ
            $table->boolean('archived')->default(false); // هل الحجز مؤرشف؟ افتراضي لا
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول الحجوزات
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings'); // حذف الجدول عند التراجع
    }
};
