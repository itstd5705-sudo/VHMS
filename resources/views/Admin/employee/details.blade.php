@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Employee Details</h2>
    <div class="card">
        <p><strong>Full Name:</strong> {{ $employee->fullName }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Phone:</strong> {{ $employee->phone }}</p>
        @if($employee->imgUrl)
            <p><strong>Image:</strong><br><img src="{{ $employee->imgUrl }}" width="120" class="rounded border border-2"></p>
        @endif
        <hr>
        <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
