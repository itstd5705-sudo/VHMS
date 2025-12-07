<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeeLogin extends Controller
{
     // صفحة تسجيل دخول الدكتور
    public function showLoginForm()
    {
        return view('employee.login');
    }
    //عملية تسجيل دخول
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('employee')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة.', ]);
    }
    //عملية تسجيل خروج
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}
