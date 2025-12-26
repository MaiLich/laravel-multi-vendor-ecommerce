@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Bộ lọc</h4>
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="forms-sample"   @if (empty($filter['id'])) action="{{ url('admin/add-edit-filter') }}" @else action="{{ url('admin/add-edit-filter/' . $filter['id']) }}" @endif   method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="cat_ids">Chọn danh mục</label>
                                    <select name="cat_ids[]" id="cat_ids" class="form-control text-dark" multiple style="height: 200px">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $section)
                                            <optgroup label="{{ $section['name'] }}">
                                                @foreach ($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}" @if (!empty($filter['category_id'] == $category['id'])) selected @endif>{{ $category['category_name'] }}</option>
                                                    @foreach ($category['sub_categories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if (!empty($filter['category_id'] == $subcategory['id'])) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option>
                                                    @endforeach
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="filter_name">Tên bộ lọc</label>
                                    <input type="text" class="form-control" id="filter_name" placeholder="Nhập tên bộ lọc" name="filter_name"  @if (!empty($filter['filter_name'])) value="{{ $filter['filter_name'] }}" @else value="{{ old('filter_name') }}" @endif>
                                </div>

                                <div class="form-group">
                                    <label for="filter_column">Cột bộ lọc (chỉ chữ thường và dùng dấu gạch dưới/không khoảng trắng)</label>
                                    <input type="text" class="form-control" id="filter_column" placeholder="Nhập cột bộ lọc" name="filter_column"  @if (!empty($filter['filter_column'])) value="{{ $filter['filter_column'] }}" @else value="{{ old('filter_column') }}" @endif>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                <button type="reset"  class="btn btn-light">Hủy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layout.footer')
    </div>
@endsection
