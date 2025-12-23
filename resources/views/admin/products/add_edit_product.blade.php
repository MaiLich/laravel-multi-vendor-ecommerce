@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Sản phẩm</h4>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Hôm nay (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">Tháng 1 - Tháng 3</a>
                                        <a class="dropdown-item" href="#">Tháng 3 - Tháng 6</a>
                                        <a class="dropdown-item" href="#">Tháng 6 - Tháng 8</a>
                                        <a class="dropdown-item" href="#">Tháng 8 - Tháng 11</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>

                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="forms-sample"
                                  @if (empty($product['id']))
                                      action="{{ url('admin/add-edit-product') }}"
                                  @else
                                      action="{{ url('admin/add-edit-product/' . $product['id']) }}"
                                  @endif
                                  method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="category_id">Chọn danh mục</label>
                                    <select name="category_id" id="category_id" class="form-control text-dark">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $section)
                                            <optgroup label="{{ $section['name'] }}">
                                                @foreach ($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}" @if (!empty($product['category_id'] == $category['id'])) selected @endif>
                                                        {{ $category['category_name'] }}
                                                    </option>
                                                    @foreach ($category['sub_categories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if (!empty($product['category_id'] == $subcategory['id'])) selected @endif>
                                                            &nbsp;&nbsp;&nbsp;-- {{ $subcategory['category_name'] }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="loadFilters">
                                    @include('admin.filters.category_filters')
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Chọn thương hiệu</label>
                                    <select name="brand_id" id="brand_id" class="form-control text-dark">
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand['id'] }}" @if (!empty($product['brand_id'] == $brand['id'])) selected @endif>
                                                {{ $brand['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="product_name" placeholder="Nhập tên sản phẩm" name="product_name"
                                           value="{{ $product['product_name'] ?? old('product_name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_code">Mã sản phẩm</label>
                                    <input type="text" class="form-control" id="product_code" placeholder="Nhập mã sản phẩm" name="product_code"
                                           value="{{ $product['product_code'] ?? old('product_code') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_color">Màu sắc</label>
                                    <input type="text" class="form-control" id="product_color" placeholder="Nhập màu sắc" name="product_color"
                                           value="{{ $product['product_color'] ?? old('product_color') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_price">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="product_price" placeholder="Nhập giá sản phẩm" name="product_price"
                                           value="{{ $product['product_price'] ?? old('product_price') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_discount">Giảm giá (%)</label>
                                    <input type="text" class="form-control" id="product_discount" placeholder="Nhập % giảm giá" name="product_discount"
                                           value="{{ $product['product_discount'] ?? old('product_discount') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_weight">Trọng lượng (%)</label>
                                    <input type="text" class="form-control" id="product_weight" placeholder="Nhập trọng lượng" name="product_weight"
                                           value="{{ $product['product_weight'] ?? old('product_weight') }}">
                                </div>

                                <div class="form-group">
                                    <label for="group_code">Mã nhóm</label>
                                    <input type="text" class="form-control" id="group_code" placeholder="Nhập mã nhóm" name="group_code"
                                           value="{{ $product['group_code'] ?? old('group_code') }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_image">Ảnh sản phẩm (Khuyến nghị: 1000x1000)</label>
                                    <input type="file" class="form-control" id="product_image" name="product_image">
                                    @if (!empty($product['product_image']))
                                        <a target="_blank" href="{{ url('front/images/product_images/large/' . $product['product_image']) }}">Xem ảnh</a>
                                        &nbsp;|&nbsp;
                                        <a href="JavaScript:void(0)" class="confirmDelete" module="product-image" moduleid="{{ $product['id'] }}">
                                            Xóa ảnh
                                        </a>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="product_video">Video sản phẩm (dưới 2MB)</label>
                                    <input type="file" class="form-control" id="product_video" name="product_video">
                                    @if (!empty($product['product_video']))
                                        <a target="_blank" href="{{ url('front/videos/product_videos/' . $product['product_video']) }}">Xem video</a>
                                        &nbsp;|&nbsp;
                                        <a href="JavaScript:void(0)" class="confirmDelete" module="product-video" moduleid="{{ $product['id'] }}">
                                            Xóa video
                                        </a>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả sản phẩm</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $product['description'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" placeholder="Nhập Meta Title" name="meta_title"
                                           value="{{ $product['meta_title'] ?? old('meta_title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" placeholder="Nhập Meta Description" name="meta_description"
                                           value="{{ $product['meta_description'] ?? old('meta_description') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" placeholder="Nhập Meta Keywords" name="meta_keywords"
                                           value="{{ $product['meta_keywords'] ?? old('meta_keywords') }}">
                                </div>

                                <div class="form-group">
                                    <label for="is_featured">Sản phẩm nổi bật</label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                                           @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
                                </div>

                                <div class="form-group">
                                    <label for="is_bestseller">Sản phẩm bán chạy</label>
                                    <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes"
                                           @if (!empty($product['is_bestseller']) && $product['is_bestseller'] == 'Yes') checked @endif>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                <button type="reset" class="btn btn-light">Hủy</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layout.footer')
    </div>
@endsection
