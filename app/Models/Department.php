<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=
    [
        'name',
        'imgUrl',
        'location',
        'description'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class ,'departmentId', 'id');
    }
}
