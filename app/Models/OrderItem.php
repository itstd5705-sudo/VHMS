<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
    protected $fillable = [
        'orderId',  // معرف الطلب
        'medId',    // معرف الدواء
        'qty',      // الكمية
        'price',    // سعر العنصر
    ];

    /**
     * العلاقة مع نموذج الطلب (Order)
     * كل OrderItem ينتمي لطلب واحد
     */
    public function Order()
    {
        return $this->belongsTo(Order::class, 'orderId', 'id');
    }

    /**
     * العلاقة مع نموذج الدواء (Medication)
     * كل OrderItem مرتبط بدواء واحد
     */
    public function Medication()
    {
        return $this->belongsTo(Medication::class, 'medId', 'id');
    }
}
