<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cardCategory extends Model
{
    protected $fillable = ['price'];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
