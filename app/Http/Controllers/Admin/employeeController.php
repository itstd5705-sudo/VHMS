<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class employeeController extends Controller
{
    
    public function index()
    {
        $employees=Employee::all();
        return view('Admin.employee.index',compact('employees'));
    }

    public function create()
    {
        return view('Admin.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'fullName'=>['required','string'],
        'password'=>['required','string'],
        'email'=>['required','string','unique:employees,email'],
        'phone'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048']
        ]);
        $employeeData=$request->except('image');

        if(Str::startsWith($employeeData['fullName'], 'Employee'))
        {
            $employeeData['fullName']='Employee#'.$employeeData['fullName'];
        }

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $path=$image->store('employee','public');
            $employeeData['imgUrl']=Storage::url($path);
        }
        Employee::create($employeeData);
        return redirect()->route('employee.index')->with('success','employee is added successfully');
    }

    public function show(Employee $employee)
    {
        return view('Admin.employee.details',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('Admin.employee.edit',compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
        'fullName'=>['required','string'],
        'password'=>['required','string'],
        'email'=>['required','string','unique:employees,email'],
        'phone'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048']
        ]);
        $employeeData=$request->except('image');

        if(Str::startsWith($employeeData['fullName'], 'Employee'))
        {
            $employeeData['fullName']='Employee#'.$employeeData['fullName'];
        }


        if($request->hasFile('image'))
        {
           if($employee->imgUrl)
            {
             Storage::disk('public')->delete(str_replace('/storage/', '', $employee->imgUrl));
            }
            $image=$request->file('image');
            $path=$image->store('employee','public');
            $employeeData['imgUrl']=Storage::url($path);
        }
        $employee->update($employeeData);
        return redirect()->route('employee.index')->with('success','employee is updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success','employee is deleted successfully');
    }

}
