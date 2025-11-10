<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Storage;
use Str;

class departmentController extends Controller
{
    public function index()
    {
        $departments=Department::all();
        return view('Admin.department.index',compact('departments'));
    }

    public function create()
    {
        return view('Admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'location'=>['required','string'],
        'description'=>['required','string']
        ]);
        $departmentData=$request->except('image');

        if(Str::startsWith($departmentData['name'], 'Department'))
        {
            $departmentData['name']='Department#'.$departmentData['name'];
        }
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $path=$image->store('department','public');
            $departmentData['imgUrl']=Storage::url($path);
        }
        Department::create($departmentData);
        return redirect()->route('department.index')->with('success','department is added successfully');
    }

    public function show(Department $department)
    {
        return view('Admin.department.details',compact('department'));
    }

    public function edit(Department $department)
    {
        return view('Admin.department.edit',compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
        'name'=>['required','string'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'location'=>['required','string'],
        'description'=>['required','string']
        ]);
        $departmentData=$request->except('image');
        if(Str::startsWith($departmentData['name'], 'Department'))
        {
            $departmentData['name']='Department#'.$departmentData['name'];
        }
        if($request->hasFile('image'))
        {
           if($department->imgUrl)
            {
              Storage::disk('public')->delete(str_replace('/storage/', '', $department->imgUrl));
            }
            $image=$request->file('image');
            $path=$image->store('department','public');
            $departmentData['imgUrl']=Storage::url($path);
        }
        $department->update($departmentData);
        return redirect()->route('department.index')->with('success','department is update successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('success','department is delete successfully');
    }
}
