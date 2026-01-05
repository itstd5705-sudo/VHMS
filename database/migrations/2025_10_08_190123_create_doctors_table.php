<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول الأطباء عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول doctors
        Schema::create('doctors', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل طبيب
            $table->string('fullName'); // الاسم الكامل للطبيب
            $table->string('password'); // كلمة المرور للطبيب
            $table->string('email')->unique(); // البريد الإلكتروني ويجب أن يكون فريداً
            $table->string('specialty')->nullable(); // التخصص، يمكن أن يكون فارغ
            $table->string('phone')->unique(); // رقم الهاتف ويجب أن يكون فريداً
            $table->string('imgUrl')->nullable(); // رابط صورة الطبيب، يمكن أن يكون فارغ
            $table->enum('status', ['active','inactive'])->default('active');
            // حالة الطبيب: مفعل أو غير مفعل، الافتراضي مفعل
            $table->integer('departmentId'); // معرف القسم المرتبط بالطبيب
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول الأطباء
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors'); // حذف الجدول عند التراجع
    }
};
