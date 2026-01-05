=<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء الجداول عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول المستخدمين
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // معرف المستخدم تلقائي
            $table->string('userName'); // اسم المستخدم
            $table->string('password'); // كلمة المرور
            $table->string('gender'); // الجنس
            $table->integer('yearOfBirth'); // سنة الميلاد
            $table->string('phone')->unique(); // رقم الهاتف ويجب أن يكون فريداً
            $table->double('balance', 10, 2)->default(0); // رصيد المستخدم بشكل عشري مع افتراضي 0
            $table->string('patient_code')->unique(); // كود المريض ويجب أن يكون فريداً
            $table->text('chronic_diseases')->nullable(); // الأمراض المزمنة، يمكن أن تكون فارغة
            $table->text('current_medications')->nullable(); // الأدوية الحالية، يمكن أن تكون فارغة
            $table->string('blood_type')->nullable(); // فصيلة الدم، يمكن أن تكون فارغة
            $table->rememberToken(); // لتخزين التوكن الخاص بتذكر الجلسة
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });

        // إنشاء جدول لتخزين رموز إعادة تعيين كلمة المرور
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // البريد الإلكتروني كمفتاح أساسي
            $table->string('token'); // التوكن لإعادة التعيين
            $table->timestamp('created_at')->nullable(); // وقت إنشاء التوكن
        });

        // إنشاء جدول الجلسات لتخزين بيانات الجلسة
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // معرف الجلسة
            $table->foreignId('user_id')->nullable()->index(); // ربط الجلسة بالمستخدم (اختياري)
            $table->string('ip_address', 45)->nullable(); // عنوان الـ IP
            $table->text('user_agent')->nullable(); // معلومات المتصفح أو الجهاز
            $table->longText('payload'); // بيانات الجلسة المخزنة
            $table->integer('last_activity')->index(); // آخر نشاط للجلسة لتسهيل الاستعلام
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف الجداول
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // حذف جدول المستخدمين
        Schema::dropIfExists('password_reset_tokens'); // حذف جدول التوكن
        Schema::dropIfExists('sessions'); // حذف جدول الجلسات
    }
};
