<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'userId',       // معرف المستخدم صاحب الطلب
        'phoneNumber',  // رقم الهاتف
        'location',     // موقع التسليم
        'total',        // إجمالي قيمة الطلب
        'note'          // ملاحظات إضافية
    ];

    /**
     * علاقة الطلب بالمستخدم (User)
     * كل طلب ينتمي لمستخدم واحد
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * علاقة الطلب بعناصره (OrderItem)
     * كل طلب يحتوي على عدة عناصر
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderId', 'id');
    }

    /**
     * بديل أو تسمية أخرى لعلاقة العناصر
     * يمكن استخدام $order->items للوصول للعناصر
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'orderId');
    }
}
