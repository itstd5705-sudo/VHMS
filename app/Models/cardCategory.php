<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardCategory extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'price',  // سعر الفئة
    ];

    /**
     * علاقة فئة الكروت بالكروت
     * كل فئة يمكن أن تحتوي على عدة كروت
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'card_category_id', 'id');
    }
}
