@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Add Appointment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('appointment.store') }}" method="POST" class="p-4 shadow rounded bg-light">
        @csrf

        <div class="mb-3">
            <label class="form-label">Doctor</label>
            <select name="doctorId" class="form-select" required>
                <option value="">-- Select Doctor --</option>
                @foreach(App\Models\Doctor::all() as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->fullName }}</option>
                @endforeach
            </select>
            @error('doctorId')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="day" class="form-control" required>
            @error('day')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" class="form-control" required>
            @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Available Schedule</label>
            <select name="availableSchedule" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
            @error('availableSchedule')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
                <option value="rejected">Rejected</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
