<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * عرض صفحة الدفع وتأكيد الطلب
     */
    public function checkoutPage()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $user = Auth::user(); // جلب المستخدم الحالي

        return view('User.pharmacy.checkout', compact('cart', 'total', 'user'));
    }

    /**
     * تنفيذ الدفع من المحفظة
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
            'address'     => 'required'
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'السلة فارغة');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $user = Auth::user();

        if ($user->balance < $total) {
            return back()->with('error', 'الرصيد غير كافي، يرجى شحن المحفظة');
        }

        DB::beginTransaction();
        try {
            // إنشاء الطلب
            $order = Order::create([
                'userId'      => $user->id,
                'phoneNumber' => $request->phoneNumber,
                'location'    => $request->address,
                'total'       => $total,
            ]);

            // إضافة عناصر الطلب
            foreach ($cart as $item) {
                OrderItem::create([
                    'orderId' => $order->id,
                    'medId'   => $item['id'],
                    'qty'     => $item['quantity'],
                    'price'   => $item['price'],
                ]);
            }

            // خصم الرصيد من المحفظة
            $user->balance -= $total;
            $user->save();

            // مسح السلة بعد الدفع
            session()->forget('cart');
            DB::commit();

            return redirect()->route('pharmacy.order.confirm', $order->id)
                             ->with('success', 'تم الدفع بنجاح من المحفظة!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء معالجة الدفع');
        }
    }

    /**
     * صفحة تأكيد الطلب
     */
    public function orderConfirm($orderId)
    {
        $order = Order::with('items.med')->findOrFail($orderId);
        return view('User.pharmacy.confirmation', compact('order'));
    }
}
