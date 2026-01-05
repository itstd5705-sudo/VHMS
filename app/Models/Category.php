<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
    protected $fillable = [
        'name',        // اسم الفئة
        'imgUrl',      // رابط صورة الفئة
        'description'  // وصف الفئة
    ];

    /**
     * علاقة الفئة بالأدوية
     * كل فئة يمكن أن تحتوي على عدة أدوية
     */
    public function medications()
    {
        return $this->hasMany(Medication::class, 'categoryId');
    }
}
