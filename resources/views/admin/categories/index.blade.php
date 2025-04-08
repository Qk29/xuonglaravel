@extends('admin.layouts.main')

@section('title')
    Category-List
@endsection
@push('styles')
    <style>
        a {
            color: white;
        }
    </style>
@endpush

@section('content')
    <h2 class="mb-2">Trang danh sách danh mục</h2>
    @if (session('message'))
        <p class="text-success"> {{ session('message') }} </p>
    @endif
    @if (session('error'))
        <p class="text-danger"> {{ session('error') }} </p>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Categories List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-solid" href="{{route('admin.categories.addCategory')}}">Add Category</a>
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
                                        <th>Category Name</th>
                                        <th>Parent Category</th>
                                        <th>Description</th>
                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($listCategories as $key => $category) 
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                                            <td>{{ $category->description }}</td>
                                           
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{route('admin.categories.editCategory', $category->id)}}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>
    
                                                    <li>
                                                        <form action="{{ route('admin.categories.deleteCategory', $category->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa danh mục này?')" style="border:none; background:none; cursor:pointer;">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $listCategories->links('pagination::bootstrap-5')}}
    </div>
@endsection

@push('scripts')
@endpush