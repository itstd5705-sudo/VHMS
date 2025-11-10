@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Department</h2>

    {{-- رسائل النجاح والخطأ --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('department.update', $department->id) }}"
          method="POST"
          class="p-4 shadow rounded bg-light"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- اسم القسم --}}
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" value="{{ old('name', $department->name) }}"
                   class="form-control" required>
        </div>

        {{-- الصورة الحالية --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($department->imgUrl)
                <img src="{{ $department->imgUrl }}" width="80" class="rounded mb-2">
            @else
                <p class="text-muted">No Image</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        {{-- الموقع --}}
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{ old('location', $department->location) }}"
                   class="form-control" required>
        </div>

        {{-- الوصف --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $department->description) }}</textarea>
        </div>

        {{-- أزرار --}}
        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
