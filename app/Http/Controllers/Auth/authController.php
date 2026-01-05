<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * -------------------
 * هذا الكنترول مسؤول عن:
 * 1. عرض صفحات تسجيل الدخول للمستخدم.
 * 2. التحقق من بيانات تسجيل الدخول.
 * 3. تسجيل المستخدم الجديد.
 * 4. تسجيل الخروج.
 */
class AuthController extends Controller
{
    /* ================== 1️⃣ عرض صفحة تسجيل الدخول ================== */
    /**
     * userLogin
     * ---------
     * تعرض نموذج تسجيل الدخول للمستخدم.
     */
    public function userLogin()
    {
        // تحميل صفحة تسجيل الدخول الخاصة بالمستخدم
        return view('auth.userLogin');
    }

    /* ================== 2️⃣ التحقق من بيانات تسجيل الدخول ================== */
    /**
     * userCheckLogin
     * --------------
     * تتحقق من اسم المستخدم وكلمة المرور، ثم تسمح بالدخول إذا كانت صحيحة.
     */
    public function userCheckLogin(Request $request)
    {
        // ✅ التحقق من صحة البيانات المدخلة
        $credentials = $request->validate([
            'userName' => ['required'],
            'password' => ['required'],
        ]);

        // ✅ محاولة تسجيل الدخول باستخدام guard الافتراضي للمستخدمين
        if (Auth::guard('web')->attempt($credentials)) {
            // تسجيل الدخول ناجح → إعادة التوجيه للصفحة الرئيسية
            return redirect()->route('home');
        }

        // فشل تسجيل الدخول → إعادة المستخدم مع رسالة خطأ
        return back()->with('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    /* ================== 3️⃣ إنشاء حساب جديد ================== */
    /**
     * register
     * --------
     * يسمح للمستخدم بالتسجيل في النظام بعد التحقق من صحة البيانات.
     */
    public function register(Request $request)
    {
        // ✅ التحقق من صحة البيانات
        $request->validate([
            'userName'    => ['required', 'unique:users,userName'], // التأكد من عدم تكرار اسم المستخدم
            'gender'      => ['required'], // يجب اختيار النوع
            'yearOfBirth' => ['required', 'integer'], // السنة يجب أن تكون رقم
            'phone'       => ['required'], // رقم الهاتف مطلوب
            'password'    => ['required', 'min:5'], // كلمة المرور لا تقل عن 5 أحرف
        ]);

        // ✅ تحضير البيانات قبل الحفظ
        $data = $request->all();
        $data['password'] = bcrypt($request->password); // تشفير كلمة المرور قبل التخزين

        // ✅ حفظ المستخدم في قاعدة البيانات
        User::create($data);

        // إعادة التوجيه لصفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('user.login')
            ->with('success', 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن');
    }

    /* ================== 4️⃣ تسجيل خروج المستخدم ================== */
    /**
     * logout
     * ------
     * ينهي جلسة المستخدم ويعيده إلى الصفحة الرئيسية.
     */
    public function logout()
    {
        // تسجيل الخروج
        Auth::guard('web')->logout();

        // إعادة التوجيه للصفحة الرئيسية
        return redirect()->route('home');
    }
}
