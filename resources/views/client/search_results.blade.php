@extends('client.layouts.main')

@section('title', 'Tìm kiếm sản phẩm')

@section('content')
<div class="container my-5">
    

    <!-- Hiển thị kết quả tìm kiếm -->
    @if($products->isEmpty())
        <h3 style="color: #20c997" class="my-4 text-center  fw-bold border-bottom pb-2">Không có sản phẩm nào phù hợp với từ khóa "{{ $searchQuery }}"</h3>
    @else
        <h4>Kết quả tìm kiếm cho: "{{ $searchQuery }}"</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-success fw-bold">
                                {{ number_format($product->price, 0, ',', '.') }} VND
                            </p>
                            <a href="{{ route('client.productDetail', $product->id) }}" class="btn btn-outline-secondary w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <a href="{{ route('client.home') }}" class="btn btn-outline-secondary w-100">← Quay về trang chủ</a>
</div>
@endsection
