@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">طلباتي</h2>
     {{-- زر الرجوع --}}
    <div class="mb-4 text-start">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> رجوع
        </a>
    </div>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>رقم الطلب: #{{ $order->id }}</span>
                    <span>المجموع: {{ number_format($order->total,2) }} LYD</span>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $item->Medication->name ?? 'دواء محذوف' }} (x{{ $item->qty }})
                                <span>{{ number_format($item->price * $item->qty,2) }} LYD</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-muted">
                    تم الطلب بتاريخ: {{ $order->created_at->format('Y-m-d H:i') }}
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center fs-5 text-secondary mt-5">لا توجد طلبات سابقة.</p>
    @endif
</div>
@endsection
