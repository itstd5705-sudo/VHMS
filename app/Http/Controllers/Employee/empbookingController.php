<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class empbookingController extends Controller
{
    public function index()
    {
        $bookings=Booking::with(['User', 'Appointment'])->get();
        return view('Employee.booking.index', compact('bookings'));
    }

    public function create()
    {
        $appointments=Appointment::with('Doctor')->where('availableSchedule', 1)->get();
        return view('Employee.booking.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $input=$request->validate([
        'userName'=>['required','string'],
        'gender'=>['required'],
        'yearOfBirth'=>['required','numeric'],
        'status'=>['required','string','in:pending,approved,rejected,cancelled'],
        'note'=>['nullable','string'],
        'phone'=>['required','string'],
        'appointmentId'=>['required','exists:appointments,id'],
        ]);
        $user = User::where('phone', $input['phone'])->first();
        if (!$user)
        {
            $user = User::create([
                'userName'=> $input['userName'],
                'phone'=> $input['phone'],
                'password'=> bcrypt('123456'),
            ]);
        }
        $input['userId'] = $user->id;
        $appointment = Appointment::findOrFail($input['appointmentId']);
        if (!$appointment->availableSchedule) {
            return redirect()->route('booking.index')->with('error', 'الموعد غير متاح');
        }
        Booking::create($input);
        return redirect()->route('Employee.booking.index')->with('success', 'Booking is added successfully');
    }

    public function show(Booking $booking)
    {
        return view('Employee.booking.details', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $appointments = Appointment::with('Doctor')->where('availableSchedule', 1)->get();
        return view('Employee.booking.edit', compact('booking', 'appointments'));
    }

    public function update(Request $request, Booking $booking)
    {
        $input = $request->validate([
            'userName'=> ['required','string'],
            'gender'=> ['required'],
            'yearOfBirth'=> ['required','numeric'],
            'status'=> ['required','string','in:pending,approved,rejected,cancelled'],
            'note'=> ['nullable','string'],
            'phone'=> ['required','string'],
            'appointmentId'=> ['required','exists:appointments,id'],
        ]);

        $user =User::where('phone', $input['phone'])->first();
        if (!$user)
        {
            $user = User::create([
                'userName'=> $input['userName'],
                'phone'=> $input['phone'],
                'password'=> bcrypt('123456'),
            ]);
        }
        $input['userId'] = $user->id;
        $appointment = Appointment::findOrFail($input['appointmentId']);
        if (!$appointment->availableSchedule) {
            return redirect()->route('booking.index')->with('error', 'الموعد غير متاح');
        }
        $booking->update($input);
        return redirect()->route('Employee.booking.index')->with('success', 'Booking is updated successfully');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('Employee.booking.index')->with('success', 'Booking is deleted successfully');
    }
}
