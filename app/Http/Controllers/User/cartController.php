<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Medication;
use Auth;
use Illuminate\Http\Request;

class cartController extends Controller
{
    //عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.pharmacy.cart', compact('cart'));
    }

    // إضافة دواء للسلة
    public function addToCart(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);
        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            $cart[$id]['quantity'] += $quantity;
        } else
        {
            $cart[$id] =
            [
                "name" => $medication->name,
                "quantity" => $quantity,
                "price" => $medication->price,
                "image" => $medication->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    // تحديث الكمية
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return back()->with('success', 'تم تحديث الكمية');
    }

    // حذف منتج من السلة
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'تم حذف المنتج');
    }
}

