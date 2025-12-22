@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Danh mục sản phẩm</h4>
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
                                  action="{{ empty($category['id']) ? url('admin/add-edit-category') : url('admin/add-edit-category/' . $category['id']) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="category_name">Tên danh mục <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="category_name"
                                           placeholder="Nhập tên danh mục"
                                           name="category_name"
                                           value="{{ !empty($category['category_name']) ? $category['category_name'] : old('category_name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="section_id">Chọn nhóm danh mục <span class="text-danger">*</span></label>
                                    <select name="section_id" id="section_id" class="form-control" required>
                                        <option value="">-- Chọn nhóm danh mục --</option>
                                        @foreach ($getSections as $section)
                                            <option value="{{ $section['id'] }}" {{ !empty($category['section_id']) && $category['section_id'] == $section['id'] ? 'selected' : '' }}>
                                                {{ $section['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="appendCategoriesLevel">
                                    @include('admin.categories.append_categories_level')
                                </div>

                                <div class="form-group">
                                    <label for="category_image">Hình ảnh danh mục</label>
                                    <input type="file" class="form-control-file" id="category_image" name="category_image" accept="image/*">
                                    <small class="text-muted">Định dạng: JPG, PNG. Kích thước khuyến nghị: 800x800px</small>

                                    @if (!empty($category['category_image']))
                                        <div class="mt-3">
                                            <strong>Hình hiện tại:</strong><br>
                                            <a href="{{ url('front/images/category_images/' . $category['category_image']) }}" target="_blank">
                                                <img src="{{ url('front/images/category_images/' . $category['category_image']) }}"
                                                     style="max-height: 150px; border-radius: 8px; margin-top: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                                     alt="Hình danh mục hiện tại">
                                            </a>
                                            <p class="mt-2">
                                                <a href="{{ url('front/images/category_images/' . $category['category_image']) }}" target="_blank">Xem ảnh đầy đủ</a>
                                                &nbsp;|&nbsp;
                                                <a href="javascript:void(0)" class="text-danger confirmDelete" module="category-image" moduleid="{{ $category['id'] }}">Xóa hình ảnh</a>
                                            </p>
                                        </div>
                                        <input type="hidden" name="current_category_image" value="{{ $category['category_image'] }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="category_discount">Giảm giá danh mục (%)</label>
                                    <input type="number" min="0" max="100" step="0.01" class="form-control" id="category_discount"
                                           placeholder="Ví dụ: 10.5"
                                           name="category_discount"
                                           value="{{ !empty($category['category_discount']) ? $category['category_discount'] : old('category_discount') }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả danh mục</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả ngắn về danh mục">{{ !empty($category['description']) ? $category['description'] : old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="url">URL danh mục</label>
                                    <input type="text" class="form-control" id="url"
                                           placeholder="Ví dụ: dien-thoai-di-dong"
                                           name="url"
                                           value="{{ !empty($category['url']) ? $category['url'] : old('url') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Tiêu đề SEO (Meta Title)</label>
                                    <input type="text" class="form-control" id="meta_title"
                                           placeholder="Nhập tiêu đề SEO"
                                           name="meta_title"
                                           value="{{ !empty($category['meta_title']) ? $category['meta_title'] : old('meta_title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Mô tả SEO (Meta Description)</label>
                                    <input type="text" class="form-control" id="meta_description"
                                           placeholder="Nhập mô tả SEO"
                                           name="meta_description"
                                           value="{{ !empty($category['meta_description']) ? $category['meta_description'] : old('meta_description') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Từ khóa SEO (Meta Keywords)</label>
                                    <input type="text" class="form-control" id="meta_keywords"
                                           placeholder="Nhập từ khóa cách nhau bằng dấu phẩy"
                                           name="meta_keywords"
                                           value="{{ !empty($category['meta_keywords']) ? $category['meta_keywords'] : old('meta_keywords') }}">
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">
                                    {{ empty($category['id']) ? 'Thêm danh mục' : 'Cập nhật danh mục' }}
                                </button>
                                <button type="reset" class="btn btn-secondary">Nhập lại</button>
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