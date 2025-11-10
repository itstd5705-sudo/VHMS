<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $fillable=
    [
        'orderId',
        'medId',
        'qty',
        'price'
    ];

     public function Order()
    {
        return $this->belongsTo(Order::class, 'orderId','id');
    }

     public function Medication()
    {
        return $this->belongsTo(Medication::class,'medId','id');
    }
}
