@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Add New Medication</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('medication.store') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Barcode</label>
            <input type="text" name="parcode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock Quantity</label>
            <input type="number" name="stockQuantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="categoryId" class="form-select" required>
                <option value="">-- Select Category --</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('medication.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
