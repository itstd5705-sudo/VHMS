<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✨ مهم
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullName',
        'email',
        'password',
        'phone',
        'imgUrl'
    ];

    protected $hidden = [
        'password',
    ];
}
