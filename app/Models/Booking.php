<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'userName',        // اسم المستخدم
        'status',          // حالة الحجز (waiting, checked_in, done, cancelled)
        'phone',           // رقم الهاتف
        'note',            // ملاحظة إضافية
        'card_number',     // رقم الكارت المستخدم إن وجد
        'balance',         // الرصيد المستخدم أو المدفوع
        'userId',          // معرف المستخدم
        'appointmentId',   // معرف الموعد
        'queue_number',    // رقم الدور
        'archived'         // مؤشر للأرشفة (true/false)
    ];

    /**
     * علاقة الحجز بالمستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * علاقة الحجز بالموعد
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointmentId', 'id');
    }
}
