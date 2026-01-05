<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول التصنيفات عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل تصنيف
            $table->string('name'); // اسم التصنيف
            $table->string('imgUrl')->nullable(); // رابط صورة التصنيف، يمكن أن يكون فارغ
            $table->text('description')->nullable(); // وصف التصنيف، يمكن أن يكون فارغ
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول التصنيفات
     */
    public function down(): void
    {
        Schema::dropIfExists('categories'); // حذف الجدول عند التراجع
    }
};
