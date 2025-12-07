<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'userName',
        'status',
        'phone',
        'note',
        'phone',
        'card_number',
        'balance',
        'userId',
        'appointmentId',
        'queue_number'
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
