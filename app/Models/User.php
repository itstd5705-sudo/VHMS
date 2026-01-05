<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // استخدام الـ Factory والـ Notifications
    use HasFactory, Notifiable;

    /**
     * الحقول التي يمكن إدخالها جماعياً (Mass Assignment)
     *
     * @var list<string>
     */
    protected $fillable = [
        'userName',           // اسم المستخدم
        'password',           // كلمة المرور
        'gender',             // الجنس
        'yearOfBirth',        // سنة الميلاد
        'phone',              // رقم الهاتف
        'balance',            // رصيد المستخدم
        'patient_code',       // كود المريض (يتولد تلقائياً)
        'chronic_diseases',   // الأمراض المزمنة (نص)
        'current_medications',// الأدوية الحالية (نص)
        'blood_type'          // فصيلة الدم
    ];
// app/Models/User.php
public function orders()
{
    return $this->hasMany(\App\Models\Order::class);
}

    /**
     * الحقول المخفية عند تحويل النموذج إلى JSON
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل بعض الحقول تلقائياً
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // تحويل حقل التحقق من الايميل لتاريخ
            'password' => 'hashed',            // تشفير كلمة المرور تلقائياً
        ];
    }

    /**
     * جلب معرف المستخدم ليتم تخزينه في الـ JWT token
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * أي بيانات إضافية نريد إضافتها في الـ JWT token
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
 * توليد كود المريض تلقائياً عند إنشاء سجل جديد
 */
protected static function booted()
{
    static::creating(function ($patient) {
        $year = date('Y'); // السنة الحالية

        // آخر رقم مستخدم لهذه السنة
        $lastPatient = User::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastPatient) {
            // استخراج الجزء الرقمي من الكود السابق بعد السنة
            $lastNumber = (int)substr($lastPatient->patient_code, 4);
        } else {
            $lastNumber = 0;
        }

        // توليد كود المريض الجديد
        $patient->patient_code = $year . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    });
}

}
