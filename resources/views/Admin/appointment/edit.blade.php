@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Appointment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('appointment.update', $appointment->id) }}" method="POST" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <!-- Doctor -->
        <div class="mb-3">
            <label class="form-label">Doctor</label>
            <select name="doctorId" class="form-control" required>
                <option value="">-- Select Doctor --</option>
                @foreach(App\Models\Doctor::all() as $doc)
                    <option value="{{ $doc->id }}" @if($appointment->doctorId == $doc->id) selected @endif>{{ $doc->fullName }}</option>
                @endforeach
            </select>
        </div>

        <!-- Day -->
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="day" value="{{ $appointment->day }}" class="form-control" required>
        </div>

        <!-- Time -->
        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" value="{{ $appointment->time }}" class="form-control" required>
        </div>

        <!-- Available Schedule -->
        <div class="mb-3">
            <label class="form-label">Available Schedule</label>
            <select name="availableSchedule" class="form-control" required>
                <option value="1" @if($appointment->availableSchedule) selected @endif>Yes</option>
                <option value="0" @if(!$appointment->availableSchedule) selected @endif>No</option>
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="approved" @if($appointment->status == 'approved') selected @endif>Approved</option>
                <option value="pending" @if($appointment->status == 'pending') selected @endif>Pending</option>
                <option value="rejected" @if($appointment->status == 'rejected') selected @endif>Rejected</option>
            </select>
        </div>

        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
