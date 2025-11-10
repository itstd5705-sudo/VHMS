<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class appointmentController extends Controller
{
    public function index()
    {
        $appointments=Appointment::with('Doctor')->get();
        return view('Admin.appointment.index',compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('Admin.appointment.create');
    }

    public function store(Request $request)
    {
         $input = $request->validate([
        'doctorId'=>['required','exists:doctors,id'],
        'day'=>['required'],
        'time'=>['required','string'],
        'availableSchedule'=>['required'],
        'status'=>['required','string'],
    ]);
    $input['availableSchedule'] = $request->availableSchedule == "1" ? true : false;
    Appointment::create($input);
    return redirect()->route('appointment.index')->with('success','Appointment is added successfully');
    }

    public function show(Appointment $appointment)
    {
        return view('Admin.appointment.details',compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('Admin.appointment.edit',compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $input=$request->validate([
        'doctorId'=>['required','exists:doctors,id'],
        'day'=>['required'],
        'time'=>['required','string'],
        'availableSchedule'=>['required','boolean'],
        'status'=>['required','string'],
        ]);
        $appointment->update($input);
        return redirect()->route('appointment.index')->with('success','appointment is updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.index')->with('success','appointment is deleted successfully');
    }
}
