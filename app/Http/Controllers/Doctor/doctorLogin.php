<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DoctorLogin
 * -----------------
 * هذا الكنترول مسؤول عن:
 * 1. عرض صفحة تسجيل الدخول للطبيب.
 * 2. عملية تسجيل الدخول والتحقق من البريد وكلمة المرور.
 * 3. عملية تسجيل الخروج.
 */
class DoctorLogin extends Controller
{
    /* ================== 1️⃣ عرض صفحة تسجيل الدخول ================== */
    /**
     * showLoginForm
     * ----------------
     * تعرض نموذج تسجيل الدخول للطبيب.
     */
    public function showLoginForm()
    {
        // يعرض صفحة login الخاصة بالطبيب
        return view('doctor.doctorLogin');
    }

    /* ================== 2️⃣ عملية تسجيل الدخول ================== */
    /**
     * login
     * ------
     * تتحقق من صحة البيانات المدخلة ثم تحاول تسجيل دخول الطبيب.
     */
    public function login(Request $request)
    {
        // ✅ التحقق من صحة البيانات
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // ✅ محاولة تسجيل الدخول باستخدام guard 'doctor'
        if (Auth::guard('doctor')->attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            // تسجيل الدخول ناجح → إعادة توجيه للوحة التحكم
            return redirect()->route('doctor.dashboard');
        }

        // فشل تسجيل الدخول → إعادة المستخدم مع رسالة خطأ
        return back()->withErrors([
            'email' => 'بيانات تسجيل الدخول غير صحيحة.',
        ]);
    }

    /* ================== 3️⃣ عملية تسجيل الخروج ================== */
    /**
     * logout
     * ------
     * تسجيل خروج الطبيب وإعادة التوجيه لصفحة تسجيل الدخول.
     */
    public function logout()
    {
        // تسجيل خروج guard 'doctor'
        Auth::guard('doctor')->logout();

        // إعادة التوجيه لصفحة تسجيل الدخول
        return redirect()->route('doctor.login');
    }
}
