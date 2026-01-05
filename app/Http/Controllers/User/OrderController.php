<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;       // موديل الطلبات
use App\Models\OrderItem;   // موديل عناصر الطلب
use App\Models\Medication;  // موديل الأدوية
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /* ================== عرض صفحة الدفع ================== */
    public function checkoutPage()
    {
        // جلب محتوى السلة من الـ session
        $cart = session('cart', []);

        // حساب المجموع الكلي للمنتجات في السلة
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // جلب بيانات المستخدم الحالي
        $user = Auth::user();

        // عرض الصفحة وتمرير السلة والمجموع والمستخدم
        return view('User.pharmacy.checkout', compact('cart', 'total', 'user'));
    }

    /* ================== تنفيذ الدفع ================== */
    public function checkout(Request $request)
    {
        // التحقق من صحة البيانات المطلوبة
        $request->validate([
            'phoneNumber' => 'required',
            'address'     => 'required'
        ]);

        $cart = session('cart', []);

        // التحقق من السلة الفارغة
        if (empty($cart)) {
            return back()->with('error', 'السلة فارغة');
        }

        $user = Auth::user();

        // حساب المجموع الكلي
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // التحقق من الرصيد الكافي في المحفظة
        if ($user->balance < $total) {
            return back()->with('error', 'الرصيد غير كافي، يرجى شحن المحفظة');
        }

        // بدء معاملة قاعدة البيانات Transaction لضمان الأمان
        DB::beginTransaction();
        try {
            // التحقق من المخزون لكل دواء قبل الدفع
            foreach ($cart as $item) {
                $med = Medication::find($item['id']);
                if (!$med) {
                    throw new \Exception("الدواء {$item['name']} غير موجود");
                }
                if ($item['quantity'] > $med->stockQuantity) {
                    throw new \Exception("الكمية المطلوبة للدواء {$item['name']} أكبر من المخزون المتاح ({$med->stockQuantity})");
                }
            }

            // إنشاء الطلب
            $order = Order::create([
                'userId'      => $user->id,
                'phoneNumber' => $request->phoneNumber,
                'location'    => $request->address,
                'total'       => $total,
            ]);

            // إنشاء عناصر الطلب وتحديث المخزون لكل دواء
            foreach ($cart as $item) {
                OrderItem::create([
                    'orderId' => $order->id,
                    'medId'   => $item['id'],
                    'qty'     => $item['quantity'],
                    'price'   => $item['price'],
                ]);

                // خصم الكمية من المخزون
                $med = Medication::find($item['id']);
                $med->stockQuantity -= $item['quantity'];
                $med->save();
            }

            // خصم المبلغ من رصيد المستخدم
            $user->balance -= $total;
            $user->save();

            // مسح السلة بعد الدفع
            session()->forget('cart');

            DB::commit(); // إنهاء المعاملة بنجاح

            // إعادة التوجيه لصفحة تأكيد الطلب مع رسالة نجاح
            return redirect()->route('pharmacy.order.confirm', $order->id)
                             ->with('success', 'تم الدفع بنجاح من المحفظة!');

        } catch (\Exception $e) {
            DB::rollBack(); // التراجع عن التغييرات في حالة حدوث خطأ
            return back()->with('error', $e->getMessage() ?? 'حدث خطأ أثناء معالجة الدفع');
        }
    }

    /* ================== صفحة تأكيد الطلب ================== */
    public function orderConfirm($orderId)
    {
        // جلب الطلب مع جميع عناصره والأدوية المرتبطة
        $order = Order::with('items.med')->findOrFail($orderId);

        // عرض صفحة التأكيد وتمرير بيانات الطلب
        return view('User.pharmacy.confirmation', compact('order'));
    }
}
