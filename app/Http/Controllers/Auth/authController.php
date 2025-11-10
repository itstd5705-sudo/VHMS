<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    // تسجيل دخول المستخدم
    public function userLogin()
    {
        return view('auth.userLogin');
    }

    //تحقق تسجيل دخول المستخدم
    public function userCheckLogin(Request $request)
    {
        $credentials = $request->validate([
            'userName' => ['required'],
            'password' => ['required']
        ]);
        if (Auth::guard('web')->attempt($credentials))
        {
            return redirect()->route('home');
        }
        return back()->with('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    //انشاء حساب
    public function register(Request $request)
    {

       $request->validate([
        'userName' => ['required','unique:users,userName'],
        'gender' => ['required'],
        'yearOfBirth' => ['required','integer'],
        'phone' => ['required'],
        'password' => ['required','min:5'],
       ]);
       $data=$request->all();
       $data['password']=bcrypt($request->password);
       User::create($data);
       return redirect()->route('user.login.form')->with('success', 'تم إنشاء الحساب بنجاح يمكنك تسجيل الدخول الآن');
    }

    //  صفحة تسجيل دخول (Admin - Doctor - Employee)
    public function staffLogin()
    {
        return view('auth.staffLogin');
    }

    // تحقق تسجيل دخول / موظف / دكتور / مدير
    public function staffCheckLogin(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
            'role'=> ['required','in:admin,doctor,employee']
        ]);
        $role = $request->role;
        $credentials = $request->only('email', 'password');
        if (Auth::guard($role)->attempt($credentials))
        {
            // تحويل كل نوع إلى صفحته
            switch ($role)
            {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'doctor':
                    return redirect()->route('doctor.profile');
                case 'employee':
                    return redirect()->route('employee.dashboard');
            }
        }
        return back()->with('error', 'بيانات الدخول غير صحيحة');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        foreach (['web', 'admin', 'doctor', 'employee'] as $guard)
        {
            if (Auth::guard($guard)->check())
            {
                Auth::guard($guard)->logout();
            }
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
