@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Doctor</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('Admin.doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullName" value="{{ $doctor->fullName }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $doctor->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" value="{{ $doctor->password }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ $doctor->phone }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Specialty</label>
            <input type="text" name="specialty" value="{{ $doctor->specialty }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="departmentId" class="form-control" required>
                <option value="">-- Select Department --</option>
                @foreach(App\Models\Department::all() as $dep)
                    <option value="{{ $dep->id }}" @if($doctor->departmentId == $dep->id) selected @endif>{{ $dep->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($doctor->imgUrl)
                <img src="{{ $doctor->imgUrl }}" width="80" class="rounded mb-2">
            @else
                <p class="text-muted">No Image</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('Admin.doctor.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
