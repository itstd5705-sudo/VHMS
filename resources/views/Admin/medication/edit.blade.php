@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Medication</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('medication.update', $medication->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ $medication->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Barcode</label>
            <input type="text" name="parcode" value="{{ $medication->parcode }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $medication->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" value="{{ $medication->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stockQuantity" value="{{ $medication->stockQuantity }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="categoryId" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach(App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" @if($medication->categoryId == $cat->id) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($medication->imgUrl)
                <img src="{{ $medication->imgUrl }}" width="80" class="rounded mb-2">
            @else
                <p class="text-muted">No Image</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('medication.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
