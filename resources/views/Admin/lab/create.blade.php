@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Add New Lab</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('Admin.lab.store') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('Admin.lab.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
