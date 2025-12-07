<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class card extends Model
{
    protected $fillable = ['card_number', 'used', 'card_category_id'];

    public function category()
    {
        return $this->belongsTo(CardCategory::class ,'card_category_id');
    }
}
