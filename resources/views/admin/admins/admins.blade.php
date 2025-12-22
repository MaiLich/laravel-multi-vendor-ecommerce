@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ tên</th>
                                            <th>Loại tài khoản</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin['id'] }}</td>
                                                <td>{{ $admin['name'] }}</td>
                                                <td>{{ $admin['type'] }}</td>
                                                <td>{{ $admin['mobile'] }}</td>
                                                <td>{{ $admin['email'] }}</td>
                                                <td>
                                                    @if ($admin['image'] != '')
                                                        <img src="{{ asset('admin/images/photos/' . $admin['image']) }}" style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('admin/images/photos/no-image.gif') }}" style="width: 60px; height: 60px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($admin['status'] == 1)
                                                        <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)" title="Đang hoạt động">
                                                            <i style="font-size: 25px; color: #4CAF50;" class="mdi mdi-bookmark-check"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)" title="Bị vô hiệu hóa">
                                                            <i style="font-size: 25px; color: #f44336;" class="mdi mdi-bookmark-outline"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($admin['type'] == 'vendor')
                                                        <a href="{{ url('admin/view-vendor-details/' . $admin['id']) }}" title="Xem chi tiết nhà bán hàng">
                                                            <i style="font-size: 25px; color: #2196F3;" class="mdi mdi-file-document"></i>
                                                        </a>
                                                    @endif
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
        </div>
        <!-- content-wrapper ends -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Bản quyền © 2025. Đã đăng ký bản quyền.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection