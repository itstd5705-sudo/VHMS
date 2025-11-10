<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'userName',
        'gender',
        'yearOfBirth',
        'phone',
        'status',
        'note',
        'userId',
        'appointmentId'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function Appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointmentId', 'id');
    }
}
