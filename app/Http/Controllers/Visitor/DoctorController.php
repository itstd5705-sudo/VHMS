<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * عرض مواعيد طبيب معين المتاحة
     */
    public function appointments($id)
    {
        $doctor = Doctor::with([
            'department',
            'appointments' => function ($query) {
                $query->where('status', 'available')
                      ->orderBy('day');
            }
        ])->findOrFail($id);

        $appointments = $doctor->appointments;

        return view('visitor.department.appointments', compact('doctor', 'appointments'));
    }

    /**
     * البحث عن الأطباء حسب الاسم، القسم أو الموقع
     */
    public function search(Request $request)
    {
        $doctors = Doctor::query();

        if ($request->name) {
            $doctors->where('fullName', 'like', '%' . $request->name . '%');
        }

        if ($request->department) {
            $doctors->where('departmentId', $request->department);
        }

        if ($request->location) {
            $doctors->where('location', 'like', '%' . $request->location . '%');
        }

        $doctors = $doctors->get();
        $departments = Department::all();

        return view('visitor.department.doctors', compact('doctors', 'departments'));
    }
}
