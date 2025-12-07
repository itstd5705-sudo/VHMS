<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable=
    [
        'doctorId',
        'day',
        'from_time',
        'to_time',
        'status',
        'price',
        'max_bookings'
    ];

    public function Doctor()
    {
         return $this->belongsTo(Doctor::class,'doctorId','id');
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class, 'appointmentId', 'id');
    }


// دالة لحساب المتبقي وتحديث الحالة
public function remainingSlots()
{
    $remaining = $this->max_bookings - $this->bookings()->count();

    // تحديث الحالة تلقائياً
    if($remaining <= 0) {
        $this->status = 'booked';
    } else {
        $this->status = 'available';
    }

    $this->save();
    return $remaining;
}
}
