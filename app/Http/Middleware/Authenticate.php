<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        // إذا كان الطلب Ajax أو API
        if ($request->expectsJson()) {
            abort(response()->json([
                'message' => 'يرجى تسجيل الدخول أولاً'
            ], 401));
        }

        // لو لاحقاً أضفت صفحة login
        // return route('login');

        return null; // لا تفعل أي إعادة توجيه الآن
    }
}
