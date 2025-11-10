<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class userDoctorController extends Controller
{
     public function index(Request $request)
    {
        $query = $request->get('query', '');

        $doctors = Doctor::with('appointments')
            ->when($query, function($q) use ($query)
            {
                $q->where('fullName', 'like', "%$query%")

                  ->orWhere('specialty', 'like', "%$query%");
            })
            ->get();
        return view('visitor.doctor.index', compact('doctors', 'query'));
    }
}
