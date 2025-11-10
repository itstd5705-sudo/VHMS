@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Appointment Details</h2>
    <div class="card">
        <p><strong>Doctor:</strong> {{ $appointment->Doctor->fullName ?? '-' }}</p>
        <p><strong>Date:</strong> {{ $appointment->day }}</p>
        <p><strong>Time:</strong> {{ $appointment->time }}</p>
        <p><strong>Available Schedule:</strong> {{ $appointment->availableSchedule ? 'Yes' : 'No' }}</p>
        <hr>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
