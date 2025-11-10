@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">سلة مشترياتك</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered text-center align-middle mb-0">
                <thead class="table-primary text-white">
                    <tr>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الإجمالي</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr class="align-middle table-row-hover">
                            <td class="fw-semibold">{{ $item['name'] }}</td>
                            <td class="text-success fw-bold">{{ number_format($item['price'], 2) }} LYD</td>
                            <td>
                                <form action="{{ route('pharmacy.updateCart', $id) }}" method="POST" class="d-flex justify-content-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control w-50 text-center me-2 rounded-pill border-primary">
                                    <button class="btn btn-sm btn-outline-success rounded-pill">تحديث</button>
                                </form>
                            </td>
                            <td class="fw-bold text-primary">{{ number_format($item['price'] * $item['quantity'], 2) }} LYD</td>
                            <td>
                                <form action="{{ route('pharmacy.removeFromCart', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <h4 class="fw-bold">المجموع الكلي: <span class="fw-bold">د.ل{{ number_format($total,2) }} </span></h4>
        </div>

        <div class="d-flex justify-content-end mt-3">
           <form action="{{ route('pharmacy.checkoutPage') }}" method="GET">
               <button class="btn btn-lg btn-gradient-primary rounded-pill px-4 py-2">تأكيد الطلب</button>
           </form>
        </div>
    @else
        <p class="text-center fs-5 text-secondary mt-5">سلة المشتريات فارغة</p>
    @endif
</div>
@endsection
