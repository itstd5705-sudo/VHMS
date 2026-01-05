<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /* ==========================
       عرض محتوى السلة
       - يعرض جميع العناصر المخزنة في الجلسة
       - يحدث المخزون الحالي لكل دواء
    ========================== */
    public function index()
    {
        $cart = session()->get('cart', []);

        // تحديث stockQuantity لكل منتج ليعكس المخزون الحالي
        foreach ($cart as $id => $item) {
            $med = Medication::find($id);
            if ($med) {
                $cart[$id]['stockQuantity'] = $med->stockQuantity;
            }
        }

        session()->put('cart', $cart);

        $user = Auth::user();
        return view('user.pharmacy.cart', compact('cart', 'user'));
    }

    /* ==========================
       إضافة دواء للسلة
       - يتحقق من كمية المخزون قبل الإضافة
       - إذا كان الدواء موجودًا مسبقًا، يتم تحديث الكمية
    ========================== */
    public function addToCart(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);
        $quantity = $request->quantity ?? 1;

        if ($quantity > $medication->stockQuantity) {
            return redirect()->back()
                ->with('error', "الكمية المطلوبة أكبر من المخزون المتوفر ({$medication->stockQuantity})");
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['quantity'] + $quantity;
            if ($newQty > $medication->stockQuantity) {
                return redirect()->back()
                    ->with('error', "لا يمكن إضافة الكمية. الحد الأقصى المتوفر: {$medication->stockQuantity}");
            }
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                'id'            => $medication->id,
                'name'          => $medication->name,
                'quantity'      => $quantity,
                'price'         => $medication->price,
                'imgUrl'        => $medication->imgUrl ?? asset('image/default-medicine.jpg'),
                'stockQuantity' => $medication->stockQuantity,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    /* ==========================
       تحديث كمية منتج في السلة
       - يتحقق من المخزون والحد الأدنى للكمية
    ========================== */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $med = Medication::find($id);

        if (!$med) {
            return back()->with('error', 'الدواء غير موجود.');
        }

        if (isset($cart[$id])) {
            $quantity = (int) $request->quantity;

            if ($quantity < 1) {
                return back()->with('error', "الكمية لا يمكن أن تكون أقل من 1");
            }

            if ($quantity > $med->stockQuantity) {
                return back()->with('error', "الكمية المطلوبة أكبر من المخزون المتوفر ({$med->stockQuantity})");
            }

            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['stockQuantity'] = $med->stockQuantity; // تحديث المخزون الحالي
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم تحديث الكمية');
    }

    /* ==========================
       حذف منتج من السلة
       - يزيل المنتج نهائيًا من الجلسة
    ========================== */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم حذف المنتج');
    }

    /* ==========================
       الدفع باستخدام المحفظة
       - يتحقق من المخزون ورصيد المستخدم
       - ينشئ طلبًا (Order) وعناصر الطلب (OrderItem)
       - يخفض الرصيد والمخزون بعد الدفع
    ========================== */
    public function checkoutWallet(Request $request)
    {
        $cart = session()->get('cart', []);
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'سلة المشتريات فارغة.');
        }

        $user = Auth::user();

        // جلب بيانات الأدوية الحالية
        $medications = Medication::whereIn('id', array_keys($cart))->get()->keyBy('id');

        // التحقق من المخزون لكل دواء
        foreach ($cart as $id => $item) {
            if (!isset($medications[$id])) {
                return redirect()->back()->with('error', "الدواء {$item['name']} غير موجود.");
            }
            $med = $medications[$id];
            if ($item['quantity'] > $med->stockQuantity) {
                return redirect()->back()
                    ->with('error', "الكمية المطلوبة للدواء {$item['name']} غير متوفرة. المتوفر: {$med->stockQuantity}");
            }
        }

        // حساب المجموع الكلي
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($user->balance < $total) {
            return redirect()->back()->with('error', 'رصيدك في المحفظة غير كافٍ.');
        }

        // تنفيذ العملية ضمن معاملة قاعدة بيانات
        DB::beginTransaction();
        try {
            // إنشاء الطلب
            $order = Order::create([
                'userId'   => $user->id,
                'total'    => $total,
                'location' => $user->address ?? 'لم يتم التحديد',
                'note'     => 'تم الدفع من المحفظة',
            ]);

            // إنشاء عناصر الطلب وتحديث المخزون
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'orderId' => $order->id,
                    'medId'   => $id,
                    'qty'     => $item['quantity'],
                    'price'   => $item['price'],
                ]);

                $medications[$id]->decrement('stockQuantity', $item['quantity']);
            }

            // خصم الرصيد
            $user->balance -= $total;
            $user->save();

            // مسح السلة
            session()->forget('cart');
            DB::commit();

            return redirect()->route('pharmacy.confirmation')
                             ->with('success', 'تم الدفع بنجاح! طلبك رقم #' . $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء معالجة الدفع');
        }
    }

    /* ==========================
       عرض الطلبات السابقة للمستخدم
       - يشمل تفاصيل كل دواء ضمن الطلب
    ========================== */
    public function myOrders()
    {
        $user = Auth::user();

        $orders = Order::where('userId', $user->id)
                       ->with('items.Medication')
                       ->latest()
                       ->get();

        return view('User.pharmacy.myOrders', compact('orders'));
    }
}
