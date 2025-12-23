@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Quản lý Banner trang chủ</h4>

                            <a href="{{ url('admin/add-edit-banner') }}" class="btn btn-primary float-right">
                                <i class="mdi mdi-plus"></i> Thêm banner mới
                            </a>

                            {{-- Thông báo thành công --}}
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive pt-3">
                                <table id="banners" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="25%">Hình ảnh</th>
                                            <th width="10%">Loại</th>
                                            <th width="20%">Liên kết</th>
                                            <th width="15%">Tiêu đề</th>
                                            <th width="10%">Alt (SEO)</th>
                                            <th width="8%">Trạng thái</th>
                                            <th width="7%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($banners as $banner)
                                            <tr>
                                                <td class="text-center">{{ $banner['id'] }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset('front/images/banner_images/' . $banner['image']) }}" target="_blank">
                                                        <img src="{{ asset('front/images/banner_images/' . $banner['image']) }}"
                                                             alt="{{ $banner['alt'] ?? $banner['title'] }}"
                                                             style="max-height: 100px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if($banner['type'] == 'Slider')
                                                        <span class="badge badge-info">Slider</span>
                                                    @else
                                                        <span class="badge badge-secondary">Cố định</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($banner['link'])
                                                        <a href="{{ $banner['link'] }}" target="_blank" class="text-primary text-truncate d-block" style="max-width: 200px;">
                                                            {{ Str::limit($banner['link'], 40) }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $banner['title'] ?: '<span class="text-muted">—</span>' }}</td>
                                                <td>{{ $banner['alt'] ?: '<span class="text-muted">—</span>' }}</td>
                                                <td class="text-center">
                                                    @if ($banner['status'] == 1)
                                                        <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)" title="Đang hiển thị">
                                                            <i style="font-size: 28px; color: #28a745;" class="mdi mdi-bookmark-check"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)" title="Đã ẩn">
                                                            <i style="font-size: 28px; color: #dc3545;" class="mdi mdi-bookmark-outline"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('admin/add-edit-banner/' . $banner['id']) }}" title="Chỉnh sửa">
                                                        <i style="font-size: 25px; color: #007bff;" class="mdi mdi-pencil-box"></i>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0)" class="confirmDelete" module="banner" moduleid="{{ $banner['id'] }}" title="Xóa banner">
                                                        <i style="font-size: 25px; color: #dc3545;" class="mdi mdi-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">
                                                    Chưa có banner nào. <a href="{{ url('admin/add-edit-banner') }}">Thêm banner đầu tiên</a>
                                                </td>
                                            </tr>
                                        @endforelse
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
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Bản quyền © {{ date('Y') }}. Đã đăng ký bản quyền.</span>
            </div>
        </footer>
    </div>
@endsection