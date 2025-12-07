<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * عرض السلة
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $user = Auth::user();

        return view('user.pharmacy.cart', compact('cart', 'user'));
    }

    /**
     * إضافة دواء للسلة
     */
    public function addToCart(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);
        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name'     => $medication->name,
                'quantity' => $quantity,
                'price'    => $medication->price,
                'imgUrl'   => $medication->imgUrl ?? asset('image/default-medicine.jpg'),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    /**
     * تحديث كمية منتج في السلة
     */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم تحديث الكمية');
    }

    /**
     * حذف منتج من السلة
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم حذف المنتج');
    }

    /**
     * الدفع باستخدام المحفظة
     */
    public function checkoutWallet(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'سلة المشتريات فارغة.');
        }

        // حساب المجموع الكلي
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $user = Auth::user();

        if ($user->balance < $total) {
            return redirect()->back()->with('error', 'رصيدك في المحفظة غير كافٍ.');
        }

        // خصم الرصيد
        $user->balance -= $total;
        $user->save();

        // إنشاء الطلب
        $order = Order::create([
            'userId'   => $user->id,
            'total'    => $total,
            'location' => $user->address ?? 'لم يتم التحديد',
            'note'     => 'تم الدفع من المحفظة',
        ]);

        // حفظ عناصر الطلب وتحديث المخزون
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'orderId' => $order->id,
                'medId'   => $id,
                'qty'     => $item['quantity'],
                'price'   => $item['price'],
            ]);

            $med = Medication::find($id);
            if ($med) {
                $med->stockQuantity -= $item['quantity'];
                $med->save();
            }
        }

        // مسح السلة
        session()->forget('cart');

        return redirect()
            ->route('pharmacy.confirmation')
            ->with('success', 'تم الدفع بنجاح! طلبك رقم #' . $order->id);
    }

    /**
     * عرض جميع الطلبات الخاصة بالمستخدم
     */
    public function myOrders()
    {
        $user = Auth::user();

        $orders = Order::with('items.Medication')
            ->where('userId', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pharmacy.myOrders', compact('orders'));
    }
}
