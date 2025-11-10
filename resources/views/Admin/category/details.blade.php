@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Category Details</h2>
    <div class="card">
        <p><strong>Name:</strong> {{ $category->name }}</p>
        @if($category->imgUrl)
            <p><strong>Image:</strong><br><img src="{{ $category->imgUrl }}" width="120" class="rounded border border-2"></p>
        @endif
        <hr>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
