@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Lab</h2>

    <form action="{{ route('Admin.lab.update', $lab->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $lab->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $lab->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" value="{{ $lab->price }}" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('Admin.lab.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
