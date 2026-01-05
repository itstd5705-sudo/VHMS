<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً
    protected $fillable = [
        'doctorId',      // معرف الطبيب
        'day',           // اليوم
        'from_time',     // وقت البداية
        'to_time',       // وقت النهاية
        'status',        // حالة الموعد (open/closed/available/booked)
        'price',         // سعر الموعد
        'max_bookings'   // الحد الأقصى للحجوزات
    ];

    /**
     * علاقة الموعد بالطبيب
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctorId', 'id');
    }

    /**
     * علاقة الموعد بالحجوزات
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'appointmentId', 'id');
    }

    /**
     * حساب عدد الحصص المتبقية للموعد وتحديث الحالة تلقائياً
     * @return int عدد الحصص المتبقية
     */
    public function remainingSlots(): int
    {
        $remaining = $this->max_bookings - $this->bookings()->count();

        // تحديث الحالة تلقائياً
        if ($remaining <= 0) {
            $this->status = 'booked';
        } else {
            $this->status = 'available';
        }

        $this->save();

        return $remaining;
    }
}
