<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable=
    [
        'userId',
        'phoneNumber',
        'location',
        'total',
        'status',
        'note'
    ];
    /**
     * هذي مع m:m /1:m
    */
    public function User()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function orderItem()
    {
        return $this->hasMany(orderItem::class,'orderId','id');
    }

    // علاقة الطلبات بالعناصر
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'orderId');
    }
}
