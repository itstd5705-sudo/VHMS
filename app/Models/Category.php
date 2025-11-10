<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=
    [
        'name',
        'imgUrl'
    ];

   public function medications()
{
    return $this->hasMany(Medication::class, 'categoryId');
}

}

