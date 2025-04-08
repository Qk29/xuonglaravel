@extends('admin.layouts.main')

@section('title')
    Product-List
@endsection
@push('styles')
    <style>
        a {
            color: white;
        }
    </style>
@endpush



@section('content')
    <h2 class="mb-2">Cập nhật sản phẩm</h2>
    @if (session('message'))
        <p class="text-success"> {{ session('message') }} </p>
    @endif
    
    <form action="{{route('admin.products.postUpdateProduct', $product->id)}}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"  >
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price"  value="{{ $product->price }}" >
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Danh mục</label>
            <select class="form-control" id="category" name="category">
                <option value="">Chọn danh mục</option>
                @foreach($listCategories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select class="form-control" id="brand_id" name="brand_id">
                <option value="">Chọn thương hiệu</option>
                @foreach($listBrands as $brand)
                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image_url" name="image_url" >
            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" width="100" alt="Ảnh sản phẩm">
            @endif
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá (%)</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ $product->discount }}" min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng tồn kho</label>
            <input oninput="updateStatus()" type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" >
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Còn hàng</option>
        <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Hết hàng</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
@endsection

@push('scripts')
<script>    
    function updateStatus() {
        var stock = document.getElementById('stock').value;
        var status = document.getElementById('status');
        if (stock > 0) {
            status.value = '1'; // Còn hàng
        } else {
            status.value = '0'; // Hết hàng
        }
    }
</script>
@endpush
