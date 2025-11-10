@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Add New Department</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('department.store') }}" method="POST" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

         <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
