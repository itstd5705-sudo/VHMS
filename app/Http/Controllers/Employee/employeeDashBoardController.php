<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Order;
use Carbon\Carbon;

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

        return view('Employee.dashboard', compact(
            'pendingBookings',
            'totalPatients',
            'recentBookings',
        ));
    }
}
