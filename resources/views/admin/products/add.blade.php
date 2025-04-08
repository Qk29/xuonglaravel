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
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    
    
    <form action="{{route('admin.products.handleAddProduct')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" >
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Danh mục</label>
            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                <option value="">Chọn danh mục</option>
                @foreach($listCategories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                <option value="">Chọn thương hiệu</option>
                @foreach($listBrands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Ảnh sản phẩm</label>
            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url">
            @error('image_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá (%)</label>
            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount') }}" min="0" max="100">
            @error('discount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng tồn kho</label>
            <input oninput="updateStatus()" type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}">
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Còn hàng</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hết hàng</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
