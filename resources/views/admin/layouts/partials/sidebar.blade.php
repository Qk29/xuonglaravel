
<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="">
                <img class="img-fluid for-white" src="{{ asset('admin/assets/images/logo/full-white.png') }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <!-- Menu items -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a href="{{ route('users.index') }}" class="sidebar-link sidebar-title link-nav">
                            <i class="bi bi-people me-2"></i>
                            Quản lý người dùng
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a href="{{route('products.index')}}" class="sidebar-link sidebar-title link-nav">
                            <i class="bi bi-box me-2"></i>
                            Quản lý sản phẩm
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a href="{{route('categories.index')}}" class="sidebar-link sidebar-title link-nav">
                            <i class="bi bi-grid me-2"></i>
                            Quản lý danh mục
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a href="#" class="sidebar-link sidebar-title link-nav">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            Báo cáo
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a href="#" class="sidebar-link sidebar-title link-nav">
                            <i class="bi bi-graph-up me-2"></i>
                            Thống kê
                        </a>
                    </li>
                    <!-- ... các menu items khác ... -->
                </ul>
            </div>
        </nav>
    </div>
</div>