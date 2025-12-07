<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentViewController extends Controller
{
    /**
     * عرض كل الأقسام مع دعم البحث
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $departments = Department::withCount('doctors')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('visitor.department.index', compact('departments'));
    }

    /**
     * عرض جميع الأطباء لقسم محدد
     */
    public function showDoctors($id)
    {
        $department = Department::with('doctors.appointments')->findOrFail($id);
        $departments = Department::all(); // لاستخدامها في القائمة الجانبية أو التنقل

        return view('visitor.department.doctors', compact('department', 'departments'));
    }
}
