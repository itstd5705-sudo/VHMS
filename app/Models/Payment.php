<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=
    [
        'orderId',
        'paymentDate',
        'paymentMethod',
        'total'
    ];

     public function Order()
    {
        return $this->belongsTo(Order::class,'orderId','id');
    }
}
