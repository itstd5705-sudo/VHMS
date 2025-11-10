<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=
    [
        'userId',
        'medId',
        'quantity'
    ];

     public function User()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

     public function Medication()
    {
        return $this->beشlongsTo(Medication::class,'medId','id');
    }

    /**
     * يحسب مجموع كية وفي سعرهن.
     * كمية يلي ف سلة ضرب سعر دواء نجيبو من علاقة بتاع الدواء
     */
    protected $appends=['total'];

    public function getTotalAttribute()
    {
        return $this->quantity * $this->Medication->pric;
    }

    /**
     * ينقص كمية من مخزن .
     * كمية دواء يلي ف مخزن نقص كمية يلي ف سلة
     */
    public function decrase()
    {
        $this->Medication()->update([
            'stockQuantity'=> $this->Medication->stockQuantity - $this->quantity

        ]);
    }
}
