<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * عرض صفحة معلومات المستخدم
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    /**
     * تحديث بيانات المستخدم
     */
    public function update(Request $request)
    {
        $request->validate([
            'userName'    => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'yearOfBirth' => 'required|integer',
            'gender'      => 'required|string',
            'password'    => 'nullable|string|min:6',
        ]);

        $user = Auth::user();

        $data = [
            'userName'    => $request->userName,
            'phone'       => $request->phone,
            'yearOfBirth' => $request->yearOfBirth,
            'gender'      => $request->gender,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * شحن الرصيد باستخدام كرت
     */
    public function chargeWallet(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
        ]);

        // البحث عن الكرت
        $card = Card::where('card_number', $request->card_number)->first();

        if (!$card) {
            return back()->with('error', 'رقم الكرت غير صحيح');
        }

        if ($card->used) {
            return back()->with('error', 'تم استخدام هذا الكرت مسبقاً');
        }

        // تحديث رصيد المستخدم
        $user = Auth::user();
        $user->balance += $card->category->price; // سعر الكرت من فئته
        $user->save();

        // تحديث حالة الكرت
        $card->used = true;
        $card->save();

        return back()->with('success', 'تم شحن الرصيد بنجاح ' . $card->category->price . " د.ل");
    }
}
