@extends('admin.layouts.main')

@section('title')
    User-List
@endsection
@push('styles')
    <style>
        a {
            color: white;
        }
    </style>
@endpush

@section('content')
    <h2 class="mb-2">Trang danh sách người dùng</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($listUsers as $user)
                                <tr>
                                    <td>
                                        <div class="table-image">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid" alt="{{ $user->name }}">
                                            @else
                                                <img src="{{ asset('assets/images/users/default.jpg') }}" class="img-fluid" alt="{{ $user->name }}">
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <div class="user-name">
                                            <span>{{ $user->name }}</span>
                                            <span>{{ $user->address }}</span>
                                        </div>
                                    </td>

                                    <td>{{ $user->phone }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.users.editUser', $user->id) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa người dùng này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function deleteUser(id) {
        const modal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/users/deleteUser/${id}`;
        
        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
    }
</script>
@endpush
