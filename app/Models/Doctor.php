<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // مهم لجعل الطبيب قادر على تسجيل الدخول
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable; // لتفعيل الإشعارات

    // الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
    protected $fillable = [
        'fullName',      // الاسم الكامل للطبيب
        'password',      // كلمة المرور
        'email',         // البريد الإلكتروني
        'specialty',     // التخصص
        'phone',         // رقم الهاتف
        'imgUrl',        // رابط صورة الطبيب
        'status',        // حالة الطبيب (active/inactive)
        'departmentId'   // معرف القسم المرتبط به
    ];

    /**
     * علاقة الطبيب بالقسم
     * كل طبيب ينتمي لقسم واحد
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }

    /**
     * علاقة الطبيب بالمواعيد
     * كل طبيب لديه عدة مواعيد
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctorId', 'id');
    }

    /**
     * علاقة الطبيب بالحجوزات
     * كل طبيب مرتبط بالحجوزات من خلال المواعيد
     */
    public function bookings()
    {
        // ملاحظة: في الكود الحالي، تستخدم 'appointmentId' وهذا قد يكون خطأ
        // لأنه من الأفضل أن يكون $this->hasManyThrough(Booking::class, Appointment::class)
        // لتوصيل الحجوزات بالمواعيد الخاصة بالطبيب
        return $this->hasMany(Booking::class, 'appointmentId', 'id');
    }

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
}
