<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * عرض صفحة تسجيل دخول المستخدم
     */
    public function userLogin()
    {
        return view('auth.userLogin');
    }

    /**
     * تحقق من بيانات تسجيل الدخول للمستخدم
     */
    public function userCheckLogin(Request $request)
    {
        $credentials = $request->validate([
            'userName' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->with('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    /**
     * إنشاء حساب جديد للمستخدم
     */
    public function register(Request $request)
    {
        $request->validate([
            'userName'    => ['required', 'unique:users,userName'],
            'gender'      => ['required'],
            'yearOfBirth' => ['required', 'integer'],
            'phone'       => ['required'],
            'password'    => ['required', 'min:5'],
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('user.login.form')
            ->with('success', 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن');
    }

    /**
     * عملية تسجيل خروج المستخدم
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
