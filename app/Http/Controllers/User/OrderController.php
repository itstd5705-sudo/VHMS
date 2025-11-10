<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

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
