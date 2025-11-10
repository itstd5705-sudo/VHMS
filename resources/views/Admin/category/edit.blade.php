@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Category</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($category->imgUrl)
                <img src="{{ $category->imgUrl }}" width="80" class="rounded mb-2">
            @else
                <p class="text-muted">No Image</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
