<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'userId',   // معرف المستخدم
        'medId',    // معرف الدواء
        'quantity'  // الكمية المطلوبة
    ];

    /**
     * علاقة السلة بالمستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * علاقة السلة بالدواء
     */
    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medId', 'id');
    }

    /**
     * يحسب مجموع السعر للدواء في السلة
     * مجموع = الكمية * سعر الدواء
     */
    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        // تصحيح اسم العلاقة واسم الحقل 'price'
        return $this->quantity * ($this->medication->price ?? 0);
    }

    /**
     * ينقص كمية الدواء في المخزن بناءً على كمية السلة
     */
    public function decreaseStock()
    {
        if ($this->medication) {
            $this->medication->update([
                'stockQuantity' => $this->medication->stockQuantity - $this->quantity
            ]);
        }
    }
}
