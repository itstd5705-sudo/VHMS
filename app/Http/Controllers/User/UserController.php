<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* ================== عرض صفحة معلومات المستخدم ================== */
    public function edit()
    {
        // جلب بيانات المستخدم الحالي
        $user = Auth::user();

        // إرسال البيانات إلى صفحة البروفايل لعرضها في النموذج
        return view('user.profile.index', compact('user'));
    }

    /* ================== تحديث بيانات المستخدم ================== */
    public function update(Request $request)
    {
        // التحقق من صحة البيانات المرسلة
        $request->validate([
            'userName'    => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'yearOfBirth' => 'required|integer',
            'gender'      => 'required|string',
            'password'    => 'nullable|string|min:6', // كلمة المرور اختيارية
        ]);

        $user = Auth::user();

        // تحضير البيانات للتحديث
        $data = [
            'userName'             => $request->userName,
            'phone'                => $request->phone,
            'yearOfBirth'          => $request->yearOfBirth,
            'gender'               => $request->gender,
            'chronic_diseases'     => $request->chronic_diseases,
            'current_medications'  => $request->current_medications,
            'blood_type'           => $request->blood_type,
        ];

        // إذا تم إرسال كلمة مرور جديدة، قم بتشفيرها
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // تحديث بيانات المستخدم
        $user->update($data);

        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    /* ================== شحن رصيد المحفظة باستخدام كرت ================== */
    public function chargeWallet(Request $request)
    {
        // التحقق من رقم الكرت
        $request->validate([
            'card_number' => 'required|string',
        ]);

        // البحث عن الكرت في قاعدة البيانات
        $card = Card::where('card_number', $request->card_number)->first();

        // إذا لم يوجد الكرت
        if (!$card) {
            return back()->with('error', 'رقم الكرت غير صحيح');
        }

        // إذا تم استخدام الكرت مسبقاً
        if ($card->used) {
            return back()->with('error', 'تم استخدام هذا الكرت مسبقاً');
        }

        // تحديث رصيد المستخدم بالمبلغ الموجود في فئة الكرت
        $user = Auth::user();
        $user->balance += $card->category->price; // قيمة الشحن
        $user->save();

        // تمييز الكرت كمستخدم
        $card->used = true;
        $card->save();

        return back()->with('success', 'تم شحن الرصيد بنجاح ' . $card->category->price . " د.ل");
    }
}
