<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index(Request $request)
    {
        // دكتور مسجل دخول
        $doctor = Auth::guard('doctor')->user();

        // جميع المواعيد
        $appointments = $doctor->appointments;

        // عدد الحجوزات
        $appointmentsCount = $appointments->count();

        // ربح اليوميات مجموعة حسب اليوم بشكل آمن
        $dailyTotals = $appointments->groupBy(function($appointment) {
            try {
                return Carbon::parse($appointment->day)->toDateString();
            } catch (\Exception $e) {
                return 'invalid-date';
            }
        })
        ->map(function($dayAppointments, $day) {
            return $dayAppointments->sum(function($appointment) {
                return $appointment->price * 0.60;
            });
        });

        // ربح اليوم الحالي
        $todayDate = Carbon::now()->toDateString();
        $todayTotal = $dailyTotals[$todayDate] ?? 0;

        // فلترة حسب يوم وتاريخ محدد إذا تم إدخالها
        $filteredTotal = null;
        if ($request->has('filter_date') && !empty($request->filter_date)) {
            try {
                $filterDate = Carbon::parse($request->filter_date)->toDateString();
                $appointments = $appointments->filter(function($appointment) use ($filterDate) {
                    try {
                        return Carbon::parse($appointment->day)->toDateString() === $filterDate;
                    } catch (\Exception $e) {
                        return false;
                    }
                });
                $filteredTotal = $dailyTotals[$filterDate] ?? 0;
            } catch (\Exception $e) {
                $filteredTotal = 0;
            }
        }

        return view('doctor.dashboard', compact(
            'doctor',
            'appointments',
            'appointmentsCount',
            'todayTotal',
            'dailyTotals',
            'filteredTotal'
        ));
    }
}
