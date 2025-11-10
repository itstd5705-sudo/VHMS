@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Doctor Details</h2>
    <div class="card">
        <p><strong>Full Name:</strong> {{ $doctor->fullName }}</p>
        <p><strong>Email:</strong> {{ $doctor->email }}</p>
        <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
        <p><strong>Specialty:</strong> {{ $doctor->specialty }}</p>
        <p><strong>Department:</strong> {{ $doctor->Department->name ?? '-' }}</p>
        @if($doctor->imgUrl)
            <p><strong>Image:</strong><br><img src="{{ $doctor->imgUrl }}" width="120" class="rounded border border-2"></p>
        @endif
        <hr>
        <a href="{{ route('Admin.doctor.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
