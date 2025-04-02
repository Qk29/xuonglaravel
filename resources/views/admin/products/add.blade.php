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
    <h2 class="mb-2">Trang thêm mới sản phẩm</h2>
    @if (session('message'))
        <p class="text-success"> {{ session('message') }} </p>
    @endif
    
    <form action="{{route('admin.products.handleAddProduct')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Danh mục</label>
            <select class="form-control" id="category" name="category">
                <option value="">Chọn danh mục</option>
                @foreach($listCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select class="form-control" id="brand_id" name="brand_id">
                <option value="">Chọn thương hiệu</option>
                @foreach($listBrands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image_url" name="image_url" >
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá (%)</label>
            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng tồn kho</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
@endsection

@push('scripts')
@endpush
