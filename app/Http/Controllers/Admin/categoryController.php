<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        $categorys=Category::all();
        return view('Admin.category.index',compact('categorys'));
    }

    public function create()
    {
        $category=Category::all();
        return view('Admin.category.create',compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'string'],
            'image'=>['nullable','image','mimes:jpg,png,gif','max:2048']
        ]);
        $categoryData=$request->except('image');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $path=$image->store('category','public');
            $categoryData['imgUrl']=Storage::url($path);
        }
        Category::create($categoryData);
        return redirect()->route('category.index')->with('success','category is added successfully');
    }

    public function show(Category $category)
    {
        return view('Admin.category.details',compact('category'));
    }

    public function edit(Category $category)
    {
        return view('Admin.category.edit',compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>['required', 'string'],
            'image'=>['nullable','image','mimes:jpg,png,gif','max:2048']
        ]);
        $categoryData=$request->except('image');
        if($request->hasFile('image'))
        {
            if($category->imgUrl)
            {
               Storage::disk('public')->delete(str_replace('/storage/', '', $category->imgUrl));
            }
            $image=$request->file('image');
            $path=$image->store('category','public');
            $categoryData['imgUrl']=Storage::url($path);
        }
        $category->update($categoryData);
        return redirect()->route('category.index')->with('success','category is updated successfully');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success','category is deleted successfully');
    }
}
