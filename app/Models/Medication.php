<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
    protected $fillable = [
        'name',          // اسم الدواء
        'parcode',       // الباركود الخاص بالدواء
        'description',   // وصف الدواء
        'price',         // سعر الدواء
        'stockQuantity', // الكمية المتوفرة في المخزون
        'imgUrl',        // رابط الصورة
        'categoryId'     // معرف الفئة المرتبطة بالدواء
    ];

    /**
     * علاقة الدواء بالفئة (Category)
     * كل دواء ينتمي لفئة واحدة
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
