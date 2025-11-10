<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;


class doctorController extends Controller
{
    public function index()
    {
        $doctors=Doctor::with('Department')->get();
        return view('Admin.doctor.index',compact('doctors'));
    }

    public function create()
    {
        return view('Admin.doctor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'fullName'=>['required','string'],
        'password'=>['required','string'],
        'email'=>['required','email','unique:doctors,email'],
        'specialty'=>['required','string'],
        'phone'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'departmentId'=>['required','exists:departments,id'],
        ]);
        $doctorData=$request->except('image');
        if(Str::startsWith($doctorData['fullName'], 'Doctor'))
        {
            $doctorData['fullName']='Doctor#'.$doctorData['fullName'];
        }

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $path=$image->store('employee','public');
            $doctorData['imgUrl']=Storage::url($path);
        }
        Doctor::create($doctorData);
        return redirect()->route('Admin.doctor.index')->with('success','doctor is added successfully');
    }
    public function show(Doctor $doctor)
    {
        return view('Admin.doctor.details',compact('doctor'));
    }
    public function edit(Doctor $doctor)
    {
        return view('Admin.doctor.edit',compact('doctor'));
    }
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
        'fullName'=>['required','string'],
        'password'=>['required','string'],
        'email'=>['required','email','unique:doctors,email'],
        'specialty'=>['required','string'],
        'phone'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'departmentId'=>['required','exists:departments,id'],
        ]);
        
        $doctorData=$request->except('image');

        if(Str::startsWith($doctorData['fullName'],'Doctor'))
        {
            $doctorData['fullName']='Doctor#'.$doctorData['fullName'];
        }

        if($request->hasFile('image'))
        {
           if($doctor->imgUrl)
           {
                Storage::disk('public')->delete(str_replace('/storage/','',$doctor->imgUrl));
           }
            $image=$request->file('image');
            $path=$image->store('doctor','public');
            $doctorData['imgUrl']=Storage::url($path);
        }
        $doctor->update($doctorData);
        return redirect()->route('Admin.doctor.index')->with('success','doctor is updated successfully');
    }
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('Admin.doctor.index')->with('success','doctor is delete successfully');
    }
}
