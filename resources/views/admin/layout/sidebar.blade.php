{{-- Sửa các vấn đề trong Sidebar của Skydash Admin Panel bằng Session --}}

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page') == 'dashboard') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Bảng điều khiển</span>
            </a>
        </li>

        @if (Auth::guard('admin')->user()->type == 'vendor')
            <li class="nav-item">
                <a @if (Session::get('page') == 'update_personal_details' || Session::get('page') == 'update_business_details' || Session::get('page') == 'update_bank_details') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Thông tin nhà bán</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-vendors">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'update_personal_details') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Thông tin cá nhân</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'update_business_details') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Thông tin kinh doanh</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'update_bank_details')     style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/bank') }}">Thông tin ngân hàng</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'sections' || Session::get('page') == 'categories' || Session::get('page') == 'products' || Session::get('page') == 'brands' || Session::get('page') == 'filters' || Session::get('page') == 'coupons') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý danh mục</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-catalogue">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'products')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Sản phẩm</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'coupons')    style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Mã giảm giá</a></li> 
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'orders') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý đơn hàng</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-orders">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'orders')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Đơn hàng</a></li>
                    </ul>
                </div>
            </li>

        @else
            <li class="nav-item">
                <a @if (Session::get('page') == 'update_admin_password' || Session::get('page') == 'update_admin_details') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Cài đặt</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-settings">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'update_admin_password') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-password') }}">Cập nhật mật khẩu quản trị</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'update_admin_details')  style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/update-admin-details') }}">Cập nhật thông tin quản trị</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'view_admins' || Session::get('page') == 'view_subadmins' || Session::get('page') == 'view_vendors' || Session::get('page') == 'view_all') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý tài khoản quản trị</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-admins">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'view_admins')    style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins/admin') }}">Quản trị viên</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'view_vendors')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins/vendor') }}">Nhà bán</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'view_all')       style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/admins') }}">Tất cả</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'sections' || Session::get('page') == 'categories' || Session::get('page') == 'products' || Session::get('page') == 'brands' || Session::get('page') == 'filters' || Session::get('page') == 'coupons') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý danh mục</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-catalogue">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'sections')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/sections') }}">Danh mục cha</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'categories') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/categories') }}">Danh mục</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'brands')     style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/brands') }}">Thương hiệu</a></li> 
                        <li class="nav-item"> <a @if (Session::get('page') == 'products')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/products') }}">Sản phẩm</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'coupons')    style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/coupons') }}">Mã giảm giá</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'filters')    style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/filters') }}">Bộ lọc</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'orders') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý đơn hàng</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-orders">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'orders')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/orders') }}">Đơn hàng</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'ratings') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-ratings" aria-expanded="false" aria-controls="ui-ratings">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý đánh giá</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-ratings">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'ratings')   style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/ratings') }}">Đánh giá & nhận xét sản phẩm</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'users' || Session::get('page') == 'subscribers') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-users">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý người dùng</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-users">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'users') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/users') }}">Người dùng</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'banners') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-banners" aria-expanded="false" aria-controls="ui-banners">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý banner</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-banners">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'banners') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/banners') }}">Banner trang chủ</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'shipping') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-shipping" aria-expanded="false" aria-controls="ui-shipping">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý vận chuyển</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-shipping">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'shipping') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ url('admin/shipping-charges') }}">Phí vận chuyển</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (Session::get('page') == 'blog') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('admin.blog.index') }}">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý blog</span>
                </a>
            </li>

        @endif

    </ul>
</nav>
