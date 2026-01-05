<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول الأقسام عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول departments
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل قسم
            $table->string('name'); // اسم القسم
            $table->string('imgUrl')->nullable(); // رابط صورة القسم، يمكن أن يكون فارغ
            $table->longText('description'); // وصف طويل للقسم
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول الأقسام
     */
    public function down(): void
    {
        Schema::dropIfExists('departments'); // حذف الجدول عند التراجع
    }
};
