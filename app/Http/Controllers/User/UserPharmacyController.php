<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserPharmacyController extends Controller
{

  // عرض كل الفئات
    public function index()
    {
        $categories = Category::with('medications')->get();
        return view('user.pharmacy.index', compact('categories'));
    }


    public function checkoutPage()
    {
       $cart = session('cart', []);
       $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
       $user = auth('web');
       return view('User.pharmacy.checkout', compact('cart', 'total', 'user'));
    }

    public function checkout(Request $request)
    {
       $request->validate([
        'phoneNumber' => 'required',
        'address' => 'required',
    ]);
       session()->forget('cart');
       return redirect()->route('pharmacy.checkoutPage')->with('success', 'تم إرسال طلبك بنجاح!');
   }

 }
