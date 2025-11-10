<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable=
    [
        'doctorId',
        'day',
        'time',
        'availableSchedule',
        'status'
    ];

    public function Doctor()
    {
         return $this->belongsTo(Doctor::class,'doctorId','id');
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class, 'appointmentId', 'id');
    }
}
