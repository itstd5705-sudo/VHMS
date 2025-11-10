<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Medication;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Device;
use App\Models\Employee;
use App\Models\Lab;
use App\Models\Test;
use Carbon\Carbon;

class dashController extends Controller
{
    public function index()
    {
        $DoctorsCount=Doctor::count();
        $EmployeesCount=Employee::count();
        $DepartmentsCount=Department::count();
        $MedicationsCount=Medication::count();
        $AppointmentsCount=Appointment::count();
        $CategoriesCount=Category::count();
        $BookingsCount=Booking::count();
        $labCount=Lab::count();
        $TestCount=Test::count();
        $DeviceCount=Device::count();
        $totalAppointments = Appointment::count();
        $bookedAppointments = Booking::count();
        $bookingOccupancy = $totalAppointments ? round(($bookedAppointments / $totalAppointments) * 100) : 0;
        // مخطط نسبة المكتملة مقابل الملغاة
        $completedCount = Booking::where('status', 'approved')->count();
        $canceledCount = Booking::where('status', 'rejected')->count();


        return view('Admin.dashboard', compact(
            'DoctorsCount',
            'EmployeesCount',
            'DepartmentsCount',
            'MedicationsCount',
            'AppointmentsCount',
            'BookingsCount',
            'CategoriesCount',
            'labCount',
            'TestCount',
            'DeviceCount',
            'totalAppointments',
            'bookedAppointments',
            'bookingOccupancy',
            'completedCount',
            'canceledCount'
        ));
    }
}
