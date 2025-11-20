<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;


class EmployeeDashBoardController extends Controller
{
    public function index()
    {
        // عدد الحجوزات المعلقة
        $pendingBookings = Booking::where('status','pending')->count();
        // إجمالي المرضى
        $totalPatients = Booking::distinct('userId')->count('userId');
        // أحدث الحجوزات (آخر 5 فقط)
        $recentBookings = Booking::latest()->take(5)->get();

         // ---- بيانات الشارت ----
        $bookingsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

        $patientsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(DISTINCT userId) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

        return view('Employee.dashboard', compact(
            'pendingBookings',
            'totalPatients',
            'recentBookings',
            'bookingsPerMonth',
            'patientsPerMonth',
        ));
    }
}
