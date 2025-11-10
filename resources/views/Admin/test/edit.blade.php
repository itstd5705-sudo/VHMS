@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Test</h2>

         <form action="{{ route('Admin.Test.update', $test)}}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $test->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $test->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ $test->price }}" class="form-control" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('Admin.Test.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>

</div>
@endsection
