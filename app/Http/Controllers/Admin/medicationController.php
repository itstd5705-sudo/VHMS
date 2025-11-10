<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class medicationController extends Controller
{
    public function index()
    {
        $medications=Medication::all();
        return view('Admin.medication.index',compact('medications'));
    }

    public function create()
    {
        return view('Admin.medication.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name'=>['required','string'],
        'parcode'=>['required','unique:medications,parcode'],
        'description'=>['required','string'],
        'price'=>['required','numeric'],
        'stockQuantity'=>['required','numeric'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'categoryId'=>['required','exists:categories,id']
        ]);
        $medicationData=$request->except('image');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $path=$image->store('medication','public');
            $medicationData['imgUrl']=Storage::url($path);
        }
        Medication::create($medicationData);
        return redirect()->route('medication.index')->with('success','medication is added successfully');
    }

    public function show(Medication $medication)
    {
        return view('Admin.medication.details',compact('medication'));
    }

    public function edit(Medication $medication)
    {
        return view('Admin.medication.edit',compact('medication'));
    }

    public function update(Request $request, Medication $medication)
    {
        $request->validate([
        'name'=>['required','string'],
        'description'=>['required','string'],
        'price'=>['required','numeric','min:0'],
        'stockQuantity'=>['required','numeric','min:0'],
        'image'=>['nullable','image','mimes:jpg,png,gif','max:2048'],
        'categoryId'=>['required','exists:categories,id']
        ]);
        $medicationData=$request->except('image');
        $medicationData['parcode']=$medication->parcode;
        if($request->hasFile('image'))
        {
           if($medication->imgUrl)
            {
               Storage::disk('public')->delete(str_replace('/storage/', '', $medication->imgUrl));
            }
            $image=$request->file('image');
            $path=$image->store('medication','public');
            $medicationData['imgUrl']=Storage::url($path);
        }
        $medication->update($medicationData);
        return redirect()->route('medication.index')->with('success','medication is updated successfully');
    }

    public function destroy(Medication $medication)
{
    if ($medication->imgUrl) {
        Storage::disk('public')->delete(str_replace('/storage/', 'public/', $medication->imgUrl));
    }

    if ($medication->stockQuantity == 0) {
        $medication->delete();
        return redirect()->route('medication.index')->with('success', 'Medication is deleted successfully');
    }

    return redirect()->route('medication.index')->with('error', 'Medication cannot be deleted because stockQuantity is not 0');
}
}
