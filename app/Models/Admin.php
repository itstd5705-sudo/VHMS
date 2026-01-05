<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Admin extends Authenticatable implements FilamentUser
{
    // استخدام الـ HasFactory و Notifiable
    use HasFactory, Notifiable;

    /**
     * الحقول التي يمكن تعبئتها جماعياً
     */
    protected $fillable = [
        'name',       // الاسم
        'email',      // البريد الإلكتروني
        'password',   // كلمة المرور
    ];

    /**
     * الحقول المخفية عند التحويل إلى JSON أو Serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل بعض الحقول تلقائياً
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // يحفظ كلمة المرور مشفرة تلقائياً
        ];
    }

    /**
     * السماح بالوصول إلى لوحة Filament
     * @param Panel $panel
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
       // أي أدمن مسجل يُسمح له بالوصول
        return true;
    }


    /**
     * دالة تتحقق إذا المستخدم أدمن (يمكن استخدامها داخل النظام)
     */
    public function isAdmin(): bool
    {
        // هنا يمكن إضافة شروط إضافية حسب الدور أو البريد
        return true; // كل مستخدم في جدول Admin يُعتبر أدمن
    }
}
