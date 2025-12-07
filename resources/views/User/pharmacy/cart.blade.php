@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">سلة مشترياتك</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($cart && count($cart) > 0)
        <div class="list-group">
            @php $total = 0; @endphp
            @foreach($cart as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="cart-row d-flex align-items-center justify-content-between mb-3 p-3 shadow-sm rounded">
                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $item['name'] }}</h5>
                            <p class="text-success mb-0">{{ number_format($item['price'],2) }} LYD</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('pharmacy.updateCart', $id) }}" method="POST" class="d-flex align-items-center gap-1 mb-0">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-decrease">-</button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm quantity-input text-center" style="width:50px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-increase">+</button>
                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill">تحديث</button>
                            </form>
                            <form action="{{ route('pharmacy.removeFromCart', $id) }}" method="POST" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill">حذف</button>
                            </form>
                        </div>
                        <span class="fw-bold text-primary">{{ number_format($item['price'] * $item['quantity'],2) }} LYD</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end mt-4">
            <h4 class="fw-bold">المجموع الكلي: <span class="fw-bold">د.ل{{ number_format($total,2) }} </span></h4>
        </div>

        <!-- زر فتح المودال -->
        <div class="d-flex justify-content-end mt-3 gap-2">
            <button class="btn btn-lg btn-success rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                الدفع بالمحفظة (رصيدك: {{ number_format($user->balance,2) }} LYD)
            </button>
        </div>

        <!-- مودال التأكيد -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form action="{{ route('pharmacy.checkoutWallet') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="checkoutModalLabel">تأكيد بيانات الدفع</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">رقم الهاتف</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="{{ $user->phone ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $user->address ?? '' }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                  <button type="submit" class="btn btn-success">تأكيد الدفع</button>
                </div>
            </form>
          </div>
        </div>
    @else
        <p class="text-center fs-5 text-secondary mt-5">سلة المشتريات فارغة</p>
    @endif
</div>

<script>
document.querySelectorAll('.cart-row').forEach(card => {
    const increaseBtn = card.querySelector('.btn-increase');
    const decreaseBtn = card.querySelector('.btn-decrease');
    const input = card.querySelector('.quantity-input');

    increaseBtn.addEventListener('click', () => input.value = parseInt(input.value)+1 );
    decreaseBtn.addEventListener('click', () => { if(parseInt(input.value)>1) input.value=parseInt(input.value)-1; });
});
</script>
@endsection
