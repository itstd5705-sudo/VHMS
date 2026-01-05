<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DepartmentViewController extends Controller
{
    /**
     * ================== عرض كل الأقسام ==================
     * عرض جميع الأقسام مع إمكانية البحث
     * البحث يدعم أول كلمة وآخر كلمة
     */
    public function index(Request $request)
    {
        // كلمة البحث
        $search = trim($request->search);

        // جلب الأقسام مع عدد الأطباء
        $departments = Department::withCount('doctors')
            ->when($search, function ($query) use ($search) {

                // تقسيم النص إلى كلمات
                $words = preg_split('/\s+/', $search);

                // أول وآخر كلمة
                $firstWord = $words[0];
                $lastWord  = end($words);

                $query->where(function ($q) use ($firstWord, $lastWord) {
                    $q->where('name', 'like', "%{$firstWord}%")
                      ->orWhere('name', 'like', "%{$lastWord}%");
                });
            })
            ->paginate(8)
            ->withQueryString();

        return view('visitor.department.index', compact('departments'));
    }

    /**
     * ================== عرض أطباء قسم معين ==================
     */
    public function showDoctors($id)
    {
        // جلب القسم
        $department = Department::findOrFail($id);

        // جلب أطباء القسم
        $doctors = Doctor::where('departmentId', $id)
            ->paginate(8);

        // جلب كل الأقسام (للقائمة الجانبية إن وجدت)
        $departments = Department::all();

        return view('visitor.department.doctors', compact(
            'department',
            'doctors',
            'departments'
        ));
    }
}
