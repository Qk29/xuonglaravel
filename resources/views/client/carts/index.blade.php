@extends('client.layouts.main')

@section('title', 'Trang Giỏ Hàng')

@section('content')
<h1 class="mt-2">Giỏ hàng</h1>
@if($cart && $cart->cartDetails->count())
    <table class="table mt-2 mb-2 table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thanh toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->cartDetails as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td><img width="100" src="{{ $item->product->image_url }}" alt=""></td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity) }}đ</td>
                    <td><a href="#" class="btn btn-warning">Thanh toán</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
    <a href="{{ route('client.home') }}" class="btn btn-outline-secondary">Quay về trang chủ</a>
@else
    <p class="alert alert-warning">Giỏ hàng của bạn đang trống.</p>
@endif

@endsection
