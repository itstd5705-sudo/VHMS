<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /* ==========================
       عرض مواعيد طبيب معين
       - يأخذ ID الطبيب
       - يحمل بيانات الطبيب مع القسم والمواعيد المفتوحة
       - يعرض صفحة المواعيد للزوار
    ========================== */
    public function appointments($id)
    {
        // جلب الطبيب والمواعيد المفتوحة والقسم المرتبط
        $doctor = Doctor::with([
            'department',
            'appointments' => function ($query) {
                $query->where('status', 'open')
                      ->orderBy('day'); // ترتيب حسب اليوم
            }
        ])->findOrFail($id);

        $appointments = $doctor->appointments;

        // تمرير البيانات للعرض
        return view('visitor.department.appointments', compact('doctor', 'appointments'));
    }

    /* ==========================
       البحث عن الأطباء
       - يدعم البحث بالاسم (كلمة أولى + كلمة أخيرة)
       - يدعم فلترة حسب القسم
       - يعرض النتائج مع ترقيم (pagination)
    ========================== */
    public function search(Request $request)
    {
        $doctors = Doctor::query();

        // 🔍 البحث بالاسم
        if ($request->filled('name')) {
            $name = trim($request->name);

            // تقسيم الاسم إلى كلمات
            $words = preg_split('/\s+/', $name);

            // البحث عن كل كلمة في الحقل fullName
            $doctors->where(function ($query) use ($words) {
                foreach ($words as $word) {
                    $query->where('fullName', 'like', "%{$word}%");
                }
            });
        }

        // 🏥 البحث حسب القسم (اختياري)
        if ($request->filled('department')) {
            $doctors->where('departmentId', $request->department);
        }

        // ترقيم النتائج 8 أطباء لكل صفحة
        $doctors = $doctors->paginate(8)->withQueryString();

        // جلب جميع الأقسام للفلتر في الصفحة
        $departments = Department::all();

        return view('visitor.department.doctors', compact('doctors', 'departments'));
    }
}
