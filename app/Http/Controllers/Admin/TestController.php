<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // عرض جميع التحاليل
    public function index()
    {
        $tests = Test::all();
        return view('Admin.test.index', compact('tests'));
    }

    // صفحة إنشاء تحليل جديد
    public function create()
    {
        return view('Admin.test.create');
    }

    // حفظ تحليل جديد
    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        ]);

        Test::create($request->only(['name', 'description', 'price']));
        return redirect()->route('Admin.Test.index')->with('success', 'تمت الإضافة بنجاح');
    }

    // عرض تفاصيل التحليل
    public function show(Test $test)
    {
        return view('Admin.test.details', compact('test'));
    }

    // صفحة تعديل التحليل
    public function edit(Test $test)
    {
        return view('Admin.test.edit', compact('test'));
    }

    // تحديث التحليل
    public function update(Request $request, Test $test)
    {
        $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        ]);

        $test->update($request->only(['name', 'description', 'price']));
        return redirect()->route('Admin.Test.index')->with('success', 'تم التعديل بنجاح');
    }

    // حذف التحليل
    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('Admin.Test.index')->with('success', 'تم الحذف بنجاح');
    }
}
