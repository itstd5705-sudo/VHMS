<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserPharmacyController extends Controller
{
    /**
     * عرض كل الفئات مع الأدوية المرتبطة بها
     */
    public function index()
    {
        $categories = Category::with('medications')->get();
        return view('user.pharmacy.index', compact('categories'));
    }

    /**
     * عرض صفحة الدفع
     */
    public function checkoutPage()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $user = Auth::user(); // جلب المستخدم الحالي

        return view('User.pharmacy.checkout', compact('cart', 'total', 'user'));
    }

    /**
     * تنفيذ الدفع (تأكيد الطلب)
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
            'address'     => 'required',
        ]);

        // مسح السلة بعد الدفع
        session()->forget('cart');

        return redirect()->route('pharmacy.checkoutPage')
                         ->with('success', 'تم إرسال طلبك بنجاح!');
    }

    /**
     * البحث عن الأدوية حسب الاسم والفئة
     */
    public function search(Request $request)
    {
        $query      = $request->input('name');
        $categoryId = $request->input('department');

        // جلب كل الفئات مع الأدوية المفلترة
        $categories = Category::with(['medications' => function($q) use ($query, $categoryId) {
            if ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            }
            if ($categoryId) {
                $q->where('categoryId', $categoryId);
            }
        }])->get();

        return view('user.pharmacy.index', compact('categories'));
    }
}
