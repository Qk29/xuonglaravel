@extends('admin.layouts.main')

@section('title')
    Add Category
@endsection
@push('styles')
    <style>
        a {
            color: white;
        }
    </style>
@endpush

@section('content')
    <h2 class="mb-2">Thêm danh mục mới</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{route('admin.categories.handleAddCategory')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" >
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
    </form>
@endsection

@push('scripts')
@endpush
