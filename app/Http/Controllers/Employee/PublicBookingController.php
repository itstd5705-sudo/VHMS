<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PublicBookingController extends Controller
{
    // دالة لعرض الحجوزات المؤكدة فقط
    public function index()
    {
      $bookings=Booking::with(['User','Appointment.Doctor'])->where('status', 'approved')->orderBy('created_at', 'desc')->get();
      return view('Employee.PublicBookingPage', compact('bookings'));
    }
}
