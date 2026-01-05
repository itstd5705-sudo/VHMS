<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * هذا الجزء ينفذ إنشاء جدول العربات (سلة المشتريات) عند تشغيل migrate
     */
    public function up(): void
    {
        // إنشاء جدول carts
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // معرف تلقائي لكل سجل في السلة
            $table->integer('userId'); // معرف المستخدم المرتبط بالسلة
            $table->integer('medId'); // معرف الدواء أو المنتج الموجود في السلة
            $table->integer('quantity')->default(1); // كمية المنتج، افتراضي 1
            $table->timestamps(); // إنشاء حقول created_at و updated_at تلقائياً
        });
    }

    /**
     * Reverse the migrations.
     * هذا الجزء للتراجع عن التغييرات، أي حذف جدول carts
     */
    public function down(): void
    {
        Schema::dropIfExists('carts'); // حذف الجدول عند التراجع
    }
};
