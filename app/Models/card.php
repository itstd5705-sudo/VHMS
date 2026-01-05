<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'card_number',       // رقم الكارت
        'used',              // حالة الاستخدام (مستخدم / غير مستخدم)
        'card_category_id'   // معرف فئة الكارت
    ];

    /**
     * علاقة الكارت بالفئة
     * كل كارت ينتمي لفئة واحدة
     */
    public function category()
    {
        return $this->belongsTo(CardCategory::class, 'card_category_id', 'id');
    }
}
