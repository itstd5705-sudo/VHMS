<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices= Device::all();
        return view('Admin.device.index', compact('devices'));
    }

    public function create()
    {
        return view('Admin.device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        ]);

        Device::create($request->only(['name','description','price']));
        return redirect()->route('Admin.Device.index')->with('success','تمت الإضافة بنجاح');
    }

    public function show(Device $device)
    {
        return view('Admin.device.details', compact('device'));
    }

    public function edit(Device $device)
    {
        return view('Admin.device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
        'name' => ['required','string'],
        'price' =>['required','numeric'],
        'description' => ['nullable','string'],
        ]);

        $device->update($request->only(['name','description','price']));
        return redirect()->route('Admin.Device.index')->with('success','تم التعديل بنجاح');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('Admin.Device.index')->with('success','تم الحذف بنجاح');
    }
}
