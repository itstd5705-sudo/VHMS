<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول الأدوية عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول medications
        Schema::create('medications', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل دواء
            $table->string('name'); // اسم الدواء
            $table->string('parcode')->unique(); // باركود الدواء ويجب أن يكون فريداً
            $table->text('description')->nullable(); // وصف الدواء، يمكن أن يكون فارغ
            $table->double('price'); // سعر الدواء
            $table->integer('stockQuantity'); // كمية المخزون المتاحة
            $table->string('imgUrl')->nullable(); // رابط صورة الدواء، يمكن أن يكون فارغ
            $table->integer('categoryId'); // معرف التصنيف المرتبط بالدواء
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول الأدوية
     */
    public function down(): void
    {
        Schema::dropIfExists('medications'); // حذف الجدول عند التراجع
    }
};
