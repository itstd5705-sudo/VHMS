<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
    protected $fillable = [
        'name',        // اسم القسم
        'imgUrl',      // رابط صورة القسم
        'description'  // وصف القسم
    ];

    /**
     * علاقة القسم بالأطباء
     * كل قسم يمكن أن يحتوي على عدة أطباء
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'departmentId', 'id');
    }
}
