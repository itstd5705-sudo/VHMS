@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">تم الدفع بنجاح!</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <p class="text-center fs-5">شكراً لتسوقك! يمكنك متابعة طلبك من صفحة <a href="{{ route('user.myOrders') }}">طلباتي</a>.</p>

    <div class="text-center mt-4">
        <a href="{{ route('pharmacy.cart') }}" class="btn btn-primary rounded-pill px-4 py-2">العودة إلى المتجر</a>
    </div>
</div>
@endsection
