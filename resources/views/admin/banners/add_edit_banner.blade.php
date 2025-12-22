@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Banner trang chủ</h4>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Hôm nay ({{ now()->format('d/m/Y') }})
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">Tháng 1 - Tháng 3</a>
                                        <a class="dropdown-item" href="#">Tháng 4 - Tháng 6</a>
                                        <a class="dropdown-item" href="#">Tháng 7 - Tháng 9</a>
                                        <a class="dropdown-item" href="#">Tháng 10 - Tháng 12</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>

                            {{-- Thông báo lỗi --}}
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Lỗi validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Thông báo thành công --}}
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="forms-sample"
                                  action="{{ empty($banner['id']) ? url('admin/add-edit-banner') : url('admin/add-edit-banner/' . $banner['id']) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="type">Loại banner <span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="">-- Chọn loại banner --</option>
                                        <option value="Slider" {{ !empty($banner['type']) && $banner['type'] == 'Slider' ? 'selected' : '' }}>
                                            Slider (Trình chiếu)
                                        </option>
                                        <option value="Fix" {{ !empty($banner['type']) && $banner['type'] == 'Fix' ? 'selected' : '' }}>
                                            Fix (Cố định)
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình ảnh banner</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                    <small class="text-muted">Định dạng: JPG, PNG, GIF. Kích thước khuyến nghị: 1920x800px (Slider) hoặc 1200x400px (Fix)</small>

                                    {{-- Hiển thị ảnh banner hiện tại nếu đang chỉnh sửa --}}
                                    @if (!empty($banner['image']))
                                        <div class="mt-3">
                                            <strong>Ảnh hiện tại:</strong><br>
                                            <a href="{{ url('front/images/banner_images/' . $banner['image']) }}" target="_blank">
                                                <img src="{{ url('front/images/banner_images/' . $banner['image']) }}"
                                                     style="max-height: 200px; border-radius: 8px; margin-top: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                                     alt="Banner hiện tại">
                                            </a>
                                            <p class="mt-2"><a href="{{ url('front/images/banner_images/' . $banner['image']) }}" target="_blank">Xem ảnh đầy đủ</a></p>
                                        </div>
                                        <input type="hidden" name="current_banner_image" value="{{ $banner['image'] }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="link">Liên kết banner (URL)</label>
                                    <input type="url" class="form-control" id="link" name="link"
                                           placeholder="Ví dụ: https://example.com/khuyen-mai"
                                           value="{{ !empty($banner['link']) ? $banner['link'] : old('link') }}">
                                    <small class="text-muted">Để trống nếu không muốn click vào banner</small>
                                </div>

                                <div class="form-group">
                                    <label for="title">Tiêu đề banner</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Ví dụ: Siêu sale Giáng sinh"
                                           value="{{ !empty($banner['title']) ? $banner['title'] : old('title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="alt">Văn bản thay thế (Alt - Tối ưu SEO)</label>
                                    <input type="text" class="form-control" id="alt" name="alt"
                                           placeholder="Ví dụ: Banner khuyến mãi Giáng sinh 50%"
                                           value="{{ !empty($banner['alt']) ? $banner['alt'] : old('alt') }}">
                                    <small class="text-muted">Giúp SEO và hỗ trợ người dùng khi ảnh không tải được</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        {{ empty($banner['id']) ? 'Thêm banner mới' : 'Cập nhật banner' }}
                                    </button>
                                    <button type="reset" class="btn btn-secondary">Nhập lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
    </div>
@endsection