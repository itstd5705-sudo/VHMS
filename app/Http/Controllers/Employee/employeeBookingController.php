<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class employeeBookingController extends Controller
{
    public function index()
    {
        $bookings=Booking::with('Appointment.Doctor') ->where('status', 'pending')->latest()->get();
        return view('Employee.booking', compact('bookings'));
    }

    public function approve($id)
    {
        $booking=Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'تمت الموافقة على الحجز بنجاح ✅');
    }

    public function reject($id)
    {
        $booking=Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);
        return back()->with('error', 'تم رفض الحجز ❌');
    }
}
