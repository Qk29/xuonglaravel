@extends('client.layouts.main')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="row">
        <h2 style="color: #20c997" class="my-4 text-center  fw-bold border-bottom pb-2">Thông tin chi tiết về sản phẩm {{$product->name}}</h2>

        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image_url) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="col-md-6">
            <h2 class="mb-3">Tên sản phẩm: {{ $product->name }}</h2>
            <h4 class="text-success fw-bold mb-3">Giá: {{ number_format($product->price, 0, ',', '.') }} VND</h4>

            <p class="mb-4">
                <strong>Mô tả:</strong><br>
                {{ $product->description }}
            </p>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Loại:</strong> Sản phẩm đẳng cấp nhất thế giới</li>
                <li class="list-group-item"><strong>Kích thước:</strong> Size S</li>
                <li class="list-group-item"><strong>Bảo hành:</strong> 10 năm</li>
                <li class="list-group-item"><strong>Tình trạng:</strong> {{$product->status == 'active' ? 'Còn Hàng' : 'Hết Hàng'}}</li>
            </ul>

            <div class="d-flex gap-3 mb-3">
                <input type="number" name="quantity" value="1" min="1" class="form-control w-25" placeholder="Số lượng">
                <form action="" method="POST" class="flex-grow-1">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">🛒 Mua ngay</button>
                </form>
            </div>

            <a href="{{ route('client.home') }}" class="btn btn-outline-secondary w-100">← Quay về trang chủ</a>
        </div>
    </div>

    <div class="mt-5">
        <h2 style="color: #20c997" class="my-4 text-center  fw-bold border-bottom pb-2">Sản phẩm có thể bạn sẽ thích</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $relatedProduct->image_url) }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-success fw-bold">
                                {{ number_format($relatedProduct->price, 0, ',', '.') }} VND
                            </p>
                            <a href="{{ route('client.productDetail', $relatedProduct->id) }}" class="btn btn-outline-secondary w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
