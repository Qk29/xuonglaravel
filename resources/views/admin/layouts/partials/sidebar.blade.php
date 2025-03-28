<div class="col-3 bg-dark position-fixed top-0 start-0 vh-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-speedometer2 me-2 fs-4"></i>
            <span class="fs-4">ShopComputer</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>
                    Quản lý người dùng
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link text-white {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <i class="bi bi-box me-2"></i>
                    Quản lý sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link text-white ">
                    <i class="bi bi-grid me-2"></i>
                    Quản lý danh mục
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Báo cáo
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-graph-up me-2"></i>
                    Thống kê
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</div> 