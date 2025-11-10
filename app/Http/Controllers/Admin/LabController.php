<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        return view('Admin.lab.index', compact('labs'));
    }

    public function create()
    {
        return view('Admin.lab.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        'image' => ['nullable','image|mimes:jpg,jpeg,png,gif|max:2048']
    ]);

    $data = $request->only(['name','description','price']);
    // حفظ الصورة إذا تم رفعها
    if($request->hasFile('image'))
    {
        $imagePath = $request->file('image')->store('labs','public');
        $data['image'] = $imagePath;
    }

    Lab::create($data);

    return redirect()->route('Admin.lab.index')->with('success','تمت الإضافة بنجاح');
    }


    public function show(Lab $lab)
    {
        return view('Admin.lab.details', compact('lab'));
    }

    public function edit(Lab $lab)
    {
        return view('Admin.lab.edit', compact('lab'));
    }

    public function update(Request $request, Lab $lab)
    {
    $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        'image' => ['nullable','image|mimes:jpg,jpeg,png,gif|max:2048']
    ]);

    $data = $request->only(['name','description','price']);
    if($request->hasFile('image'))
    {
        // حذف الصورة القديمة إذا كانت موجودة
        if($lab->image && \Storage::disk('public')->exists($lab->image)){
            \Storage::disk('public')->delete($lab->image);
        }
        $imagePath = $request->file('image')->store('labs','public');
        $data['image'] = $imagePath;
    }
    $lab->update($data);
    return redirect()->route('Admin.lab.index')->with('success','تم التعديل بنجاح');
    }
    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('Admin.lab.index')->with('success','تم الحذف بنجاح');
    }

}
