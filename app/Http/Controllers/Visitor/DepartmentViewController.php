<?php
namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentViewController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::query();

        //  البحث
        if ($request->search)
        {
            $query->where('name', 'LIKE', "%{$request->search}%") ->orWhere('location', 'LIKE', "%{$request->search}%");
        }

        $departments = $query->orderBy('name')->get();
        return view('visitor.departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
        // Route Model Binding يقوم بإيجاد القسم تلقائياً
        return view('visitor.departments.show', compact('department'));
    }
}

