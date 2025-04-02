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
    <h2 class="mb-2">Trang danh sách sản phẩm</h2>
    @if (session('message'))
        <p class="text-success"> {{ session('message') }} </p>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Products List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">import</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Export</a>
                                </li>
                                <li>
                                    <a class="btn btn-solid" href="{{route('admin.products.addProduct')}}">Add Product</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table all-package theme-table table-product" id="table_id">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Product Name</th>
                                        
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        
                                        <th>Action</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($listProduct as $key => $product) 
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            
                                            <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $product->discount }} %</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>
    
                                                    <li>
                                                        <a href="{{route('admin.products.editProduct', $product->id)}}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>
    
                                                    <li>
                                                        <form action="{{ route('admin.products.deleteProduct', $product->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" style="border:none; background:none; cursor:pointer;">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                @if ($product->image_url)
                                                
                                                    <img src="{{ asset('storage/'.$product->image_url) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                                                @else
                                                    <span>Không có ảnh</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $listProduct->links('pagination::bootstrap-5')}}

    </div>
@endsection

@push('scripts')
@endpush
