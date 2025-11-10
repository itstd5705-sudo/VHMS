<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{

     use Notifiable;
     protected $fillable=
    [
        'fullName',
        'password',
        'email',
        'specialty',
        'phone',
        'imgUrl',
        'departmentId'
    ];

    public function Department()
    {
        return $this->belongsTo(Department::class, 'departmentId','id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'doctorId','id');
    }
}
