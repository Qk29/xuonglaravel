<!-- resources/views/client/home.blade.php -->

@extends('client.layouts.main')

@section('title', 'Trang Chủ')

@section('content')
<div class="container">
    <h2 style="color: #20c997" class="my-4 text-center  fw-bold border-bottom pb-2">Các sản phẩm mới nhất</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($listProducts as $product)
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-success fw-bold">
                        {{ number_format($product->price, 0, ',', '.') }} VND
                    </p>
                    <form action="{{route('client.productDetail',$product->id)}}" method="GET" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Mua ngay</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $listProducts->links('pagination::bootstrap-5') }}
</div>

@endsection
