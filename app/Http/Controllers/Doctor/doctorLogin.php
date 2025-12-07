<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class doctorLogin extends Controller
{
    // صفحة تسجيل دخول الدكتور
    public function showLoginForm()
    {
        return view('doctor.login');
    }
    //عملية تسجيل دخول
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('doctor')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            return redirect()->route('doctor.dashboard');
        }

        return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة.', ]);
    }
    //عملية تسجيل خروج
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
