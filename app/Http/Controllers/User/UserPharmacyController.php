<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Medication;

class UserPharmacyController extends Controller
{
    /* ================== عرض كل الفئات مع الأدوية المتاحة فقط ================== */
    public function index()
    {
        // جلب كل الفئات مع الأدوية المتوفرة فقط (stockQuantity > 0)
        $categories = Category::with(['medications' => function($q){
            $q->where('stockQuantity', '>', 0); // فقط الأدوية المتوفرة
        }])->get();

        // إزالة أي فئة لا تحتوي على أدوية متوفرة
        $categories = $categories->filter(fn($category) => $category->medications->isNotEmpty());

        // عرض الصفحة وإرسال الفئات والأدوية
        return view('user.pharmacy.index', compact('categories'));
    }

    /* ================== صفحة الدفع ================== */
    public function checkoutPage()
    {
        // جلب محتوى السلة من الجلسة
        $cart = session('cart', []);

        // حساب المجموع الكلي للسلة
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // جلب بيانات المستخدم الحالي
        $user = Auth::user();

        // إرسال البيانات لصفحة الدفع
        return view('user.pharmacy.checkout', compact('cart', 'total', 'user'));
    }

    /* ================== تنفيذ الدفع ================== */
    public function checkout(Request $request)
    {
        // التحقق من صحة البيانات المطلوبة للدفع
        $request->validate([
            'phoneNumber' => 'required',
            'address'     => 'required',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'السلة فارغة');
        }

        $user = Auth::user();

        // جلب كل الأدوية الموجودة في السلة مرة واحدة لتحسين الأداء
        $medicationsIds = array_keys($cart);
        $medications = Medication::whereIn('id', $medicationsIds)->get()->keyBy('id');

        // التحقق من المخزون لكل دواء
        foreach ($cart as $id => $item) {
            if (!isset($medications[$id]) || $item['quantity'] > $medications[$id]->stockQuantity) {
                return redirect()->back()->with('error', "الكمية المطلوبة للدواء {$item['name']} غير متوفرة.");
            }
        }

        // حساب المجموع الكلي للسلة
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // التحقق من رصيد المستخدم
        if ($user->balance < $total) {
            return redirect()->back()->with('error', 'رصيد المحفظة غير كافي.');
        }

        // بدء معاملة قاعدة البيانات (transaction) لضمان التحديث الآمن
        DB::beginTransaction();
        try {
            // خصم الرصيد من المستخدم
            $user->balance -= $total;
            $user->save();

            // تحديث المخزون لكل دواء
            foreach ($cart as $id => $item) {
                $med = $medications[$id];
                $med->stockQuantity -= $item['quantity'];
                $med->save();
            }

            // مسح السلة بعد الدفع
            session()->forget('cart');

            DB::commit(); // تأكيد العملية
            return redirect()->route('pharmacy.checkoutPage')
                             ->with('success', 'تم إرسال طلبك بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack(); // إلغاء التغييرات إذا حدث خطأ
            return redirect()->back()->with('error', 'حدث خطأ أثناء معالجة الدفع');
        }
    }

    /* ================== البحث عن الأدوية ================== */
    public function search(Request $request)
    {
        $query = $request->input('name');           // الاسم المراد البحث عنه
        $categoryId = $request->input('department'); // الفئة المختارة

        // البحث عن الأدوية المتوفرة فقط
        $queryBuilder = Medication::where('stockQuantity', '>', 0);

        if ($query) {
            // البحث بالكلمات الجزئية
            $queryBuilder->where('name', 'like', "%$query%");
        }
        if ($categoryId) {
            // فلترة حسب الفئة
            $queryBuilder->where('categoryId', $categoryId);
        }

        // جلب النتائج وتجميعها حسب الفئة
        $medications = $queryBuilder->get()->groupBy('categoryId');

        // جلب الفئات المرتبطة بالأدوية الموجودة فقط
        $categories = Category::whereIn('id', $medications->keys())->get();

        // إرفاق الأدوية لكل فئة
        foreach ($categories as $category) {
            $category->medications = $medications[$category->id] ?? collect();
        }

        // إزالة الفئات الفارغة بعد البحث
        $categories = $categories->filter(fn($category) => $category->medications->isNotEmpty());

        return view('user.pharmacy.index', compact('categories'));
    }
}
