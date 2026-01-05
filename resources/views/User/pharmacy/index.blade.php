@php
$cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
@endphp
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">
@endsection

@section('content')
<!-- 🔍 شريط البحث -->
<div class="bg-light p-4 rounded-4 shadow-sm mb-5 border">
    <form action="{{ route('pharmacy.search') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-md-5">
            <input type="text" name="name" class="form-control rounded-pill" placeholder="ابحث عن دواء " value="{{ request('name') }}">
        </div>

        <div class="col-md-4">
            <select name="department" class="form-select rounded-pill">
                <option value="">كل الفئات</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('department') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-info w-100 rounded-pill text-white">بحث</button>
        </div>
    </form>
</div>

<div class="container py-5">
    @foreach($categories as $category)
        <div class="category-section mb-5">
            <h3 class="fw-bold mb-2 text-center">{{ $category->name }}</h3>
            <p class="text-center text-muted mb-4">{{ $category->description }}</p>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($category->medications as $med)
                    @if($med->stockQuantity > 0)
                        <div class="col">
                            <div class="pharmacy-card card shadow-sm h-100" data-stock="{{ $med->stockQuantity }}">
                                <img src="{{ $med->imgUrl ? asset('storage/'.$med->imgUrl) : asset('image/default-medicine.jpg') }}" class="pharmacy-img" alt="{{ $med->name }}">
                                <div class="pharmacy-card-body d-flex flex-column justify-content-between text-center">
                                    <h6 class="pharmacy-card-title fw-bold">{{ $med->name }}</h6>
                                    <p class="text-success fw-bold">{{ number_format($med->price, 2) }} LYD</p>

                                    <form action="{{ route('pharmacy.addToCart', $med->id) }}" method="POST" class="mt-auto d-flex flex-column gap-2">
                                        @csrf
                                        <div class="pharmacy-quantity-box d-flex align-items-center justify-content-center mb-2">
                                            <button type="button" class="btn btn-outline-primary btn-sm minus-btn">-</button>
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $med->stockQuantity }}" class="form-control text-center mx-2 pharmacy-quantity-input">
                                            <button type="button" class="btn btn-outline-primary btn-sm plus-btn">+</button>
                                        </div>
                                        <button class="btn btn-primary btn-pharmacy-add-to-cart d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-plus me-1"></i> إضافة للسلة
                                        </button>
                                        <small class="text-secondary">المتوفر: {{ $med->stockQuantity }}</small>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<!-- 🛒 أيقونة السلة -->
<a href="{{ route('pharmacy.cart') }}" class="floating-cart">
    <i class="bi bi-cart-fill"></i>
    <span class="cart-count">{{ $cartCount }}</span>
</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartCount = document.querySelector('.cart-count');

    document.querySelectorAll('.pharmacy-card').forEach(card => {
        const minusBtn = card.querySelector('.minus-btn');
        const plusBtn = card.querySelector('.plus-btn');
        const qtyInput = card.querySelector('.pharmacy-quantity-input');
        const addBtn = card.querySelector('.btn-pharmacy-add-to-cart');
        const maxQty = parseInt(card.dataset.stock) || 999;

        minusBtn.addEventListener('click', () => {
            qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
        });

        plusBtn.addEventListener('click', () => {
            qtyInput.value = Math.min(maxQty, parseInt(qtyInput.value) + 1);
        });

        addBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = addBtn.closest('form');
            let count = parseInt(cartCount.textContent) || 0;
            count += parseInt(qtyInput.value);
            cartCount.textContent = count;
            form.submit();
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartCount = document.querySelector('.cart-count');

    document.querySelectorAll('.pharmacy-card').forEach(card => {
        const minusBtn = card.querySelector('.minus-btn');
        const plusBtn = card.querySelector('.plus-btn');
        const qtyInput = card.querySelector('.pharmacy-quantity-input');
        const addBtn = card.querySelector('.btn-pharmacy-add-to-cart');
        const maxQty = parseInt(card.dataset.stock) || 999; // المخزون المتوفر

        minusBtn.addEventListener('click', () => {
            qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
        });

        plusBtn.addEventListener('click', () => {
            let current = parseInt(qtyInput.value);
            if (current < maxQty) {
                qtyInput.value = current + 1;
            } else {
                alert('⚠️ الكمية المطلوبة غير متوفرة في المخزون!');
            }
        });

        // منع المستخدم من كتابة قيمة أكبر من المخزون يدوياً
        qtyInput.addEventListener('input', () => {
            let val = parseInt(qtyInput.value);
            if (val > maxQty) {
                alert('⚠️ الكمية المطلوبة غير متوفرة في المخزن!');
                qtyInput.value = maxQty;
            } else if (val < 1 || isNaN(val)) {
                qtyInput.value = 1;
            }
        });

        addBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = addBtn.closest('form');
            let requestedQty = parseInt(qtyInput.value);
            if (requestedQty > maxQty) {
                alert('⚠️ الكمية المطلوبة غير متوفرة في المخزن!');
                qtyInput.value = maxQty;
                return;
            }
            let count = parseInt(cartCount.textContent) || 0;
            count += requestedQty;
            cartCount.textContent = count;
            form.submit();
        });
    });
});
</script>

@endsection
