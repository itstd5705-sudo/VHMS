@php
$cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
@endphp
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">
@endsection

@section('content')
<section class="about-hero-section">
    <div class="container text-center">
        <h2 class="hero-title">Pharmacy</h2>
         <p class="hero-description">
            Venice Hospital has been a pioneer in healthcare since 1985. Our facility in Benghazi offers state-of-the-art medical services in a patient-friendly environment.
        </p>
    </div>
</section>

<div class="container py-5">
    @foreach($categories as $category)
    <div class="category-section mb-5">
        <h3 class="fw-bold mb-3">{{ $category->name }}</h3>
        <p>{{ $category->description }}</p>

        <div class="row g-3">
            @foreach($category->medications as $med)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="med-card card shadow-sm h-100 text-center">
                    <img src="{{ $med->imgUrl ?? asset('images/default-medicine.jpg') }}"
                         class="med-img" alt="{{ $med->name }}">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold">{{ $med->name }}</h6>
                        <p class="text-success fw-bold">{{ number_format($med->price, 2) }} LYD</p>

                        <form action="{{ route('pharmacy.addToCart', $med->id) }}" method="POST" class="mt-auto d-flex flex-column gap-2">
                            @csrf
                            <div class="quantity-box d-flex align-items-center justify-content-center mb-2">
                                <button type="button" class="btn btn-outline-primary btn-sm minus-btn">-</button>
                                <input type="number" name="quantity" value="1" min="1" class="form-control text-center mx-2 quantity-input">
                                <button type="button" class="btn btn-outline-primary btn-sm plus-btn">+</button>
                            </div>
                            <button class="btn btn-primary btn-add-to-cart d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<a href="{{ route('pharmacy.cart') }}" class="floating-cart">
    <i class="bi bi-cart-fill"></i>
    <span class="cart-count">{{ $cartCount }}</span>
</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cart = document.querySelector('.floating-cart');
    const cartCount = document.querySelector('.cart-count');

    document.querySelectorAll('.med-card').forEach(card => {
        const minusBtn = card.querySelector('.minus-btn');
        const plusBtn = card.querySelector('.plus-btn');
        const qtyInput = card.querySelector('.quantity-input');
        const addBtn = card.querySelector('.btn-add-to-cart');
        const medImg = card.querySelector('.med-img');

        minusBtn.addEventListener('click', () => {
            qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
        });
        plusBtn.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        addBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = addBtn.closest('form');

            const flyingImg = medImg.cloneNode(true);
            flyingImg.classList.add('flying-med');
            document.body.appendChild(flyingImg);

            const imgRect = medImg.getBoundingClientRect();
            const cartRect = cart.getBoundingClientRect();

            flyingImg.style.left = imgRect.left + 'px';
            flyingImg.style.top = imgRect.top + 'px';

            setTimeout(() => {
                flyingImg.style.transform = `translate(${cartRect.left - imgRect.left}px, ${cartRect.top - imgRect.top}px) scale(0.1)`;
                flyingImg.style.opacity = '0.5';
            }, 50);

            flyingImg.addEventListener('transitionend', () => {
                flyingImg.remove();

                let count = parseInt(cartCount.textContent) || 0;
                count += parseInt(qtyInput.value);
                cartCount.textContent = count;

                cart.classList.add('shake');
                cartCount.classList.add('bump');
                setTimeout(() => {
                    cart.classList.remove('shake');
                    cartCount.classList.remove('bump');
                }, 500);
            });

            form.submit();
        });
    });
});
</script>
@endsection
