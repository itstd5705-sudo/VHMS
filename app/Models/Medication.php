<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable=
    [
        'name',
        'parcode',
        'description',
        'price',
        'stockQuantity',
        'imgUrl',
        'categoryId'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
