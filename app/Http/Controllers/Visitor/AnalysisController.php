<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Lab;
use App\Models\Test;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
     public function index(Request $request)
    {
        $query = $request->input('search');

        $tests = Test::when($query, function ($q) use ($query)
        {
            $q->where('name', 'like', "%{$query}%");
        })->get();

        $labs = Lab::when($query, function ($q) use ($query)
        {
            $q->where('name', 'like', "%{$query}%");
        })->get();

        $devices = Device::when($query, function ($q) use ($query)
        {
            $q->where('name', 'like', "%{$query}%");
        })->get();
        return view('visitor.analysis.index', compact('tests', 'labs', 'devices', 'query'));
    }
}
