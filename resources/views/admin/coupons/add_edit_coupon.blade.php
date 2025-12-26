{{-- Biến được truyền vào từ phương thức addEditCoupon() trong Admin/CouponsController --}}
@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Mã giảm giá</h4>
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

                            <form class="forms-sample"
                                  @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/' . $coupon['id']) }}" @endif
                                  method="post" enctype="multipart/form-data">
                                @csrf

                                @if (empty($coupon['coupon_code']))
                                    <div class="form-group">
                                        <label for="coupon_option">Tùy chọn mã giảm giá:</label><br>
                                        <span><input type="radio" id="AutomaticCoupon" name="coupon_option" value="Automatic" checked>&nbsp;Tự động&nbsp;&nbsp;</span>
                                        <span><input type="radio" id="ManualCoupon"    name="coupon_option" value="Manual"           >&nbsp;Thủ công&nbsp;&nbsp;</span>
                                    </div>
                                    <div class="form-group" style="display: none" id="couponField">
                                        <label for="coupon_code">Mã giảm giá:</label>
                                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="coupon_code">
                                    </div>
                                @else
                                    <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                                    <input type="hidden" name="coupon_code"   value="{{ $coupon['coupon_code'] }}">

                                    <div class="form-group">
                                        <label for="coupon_code">Mã giảm giá:</label>
                                        <span style="color: green; font-weight: bold">{{ $coupon['coupon_code'] }}</span>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="coupon_type">Loại mã giảm giá:</label><br>
                                    <span><input type="radio" name="coupon_type" value="Multiple Times"  @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Multiple Times') checked @endif>&nbsp;Dùng nhiều lần&nbsp;&nbsp;</span>
                                    <span><input type="radio" name="coupon_type" value="Single Time"     @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Single Time')    checked @endif>&nbsp;Dùng một lần&nbsp;&nbsp;</span>
                                </div>

                                <div class="form-group">
                                    <label for="amount_type">Loại giá trị:</label><br>
                                    <span><input type="radio" name="amount_type" value="Percentage"  @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Percentage') checked @endif>&nbsp;Phần trăm&nbsp;(%)&nbsp;</span>
                                    <span><input type="radio" name="amount_type" value="Fixed"       @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Fixed')      checked @endif>&nbsp;Cố định&nbsp;(INR hoặc USD)</span>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Giá trị:</label>
                                    <input type="text" class="form-control" id="amount" placeholder="Nhập giá trị mã giảm giá" name="amount"  @if (isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @else value="{{ old('amount') }}" @endif>
                                </div>

                                <div class="form-group">
                                    <label for="categories">Chọn danh mục:</label>
                                    <select name="categories[]" class="form-control text-dark" multiple>
                                        @foreach ($categories as $section)
                                            <optgroup label="{{ $section['name'] }}">
                                                @foreach ($section['categories'] as $category)

                                                    <option value="{{ $category['id'] }}"  @if (in_array($category['id'], $selCats)) selected @endif>&nbsp;&nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }}</option>
                                                    @foreach ($category['sub_categories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if (in_array($subcategory['id'], $selCats)) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option>
                                                    @endforeach

                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brands">Chọn thương hiệu:</label>
                                    <select name="brands[]" class="form-control text-dark" multiple>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand['id'] }}" @if (in_array($brand['id'], $selBrands)) selected @endif>{{ $brand['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="users">Chọn người dùng (theo email):</label>
                                    <select name="users[]" class="form-control text-dark" multiple>
                                        @foreach ($users as $user)
                                            <option value="{{ $user['email'] }}"  @if (in_array($user['email'], $selUsers)) selected @endif>{{ $user['email'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="expiry_date">Ngày hết hạn:</label>
                                    <input type="date" class="form-control" id="expiry_date" placeholder="Nhập ngày hết hạn" name="expiry_date"  @if (isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @else value="{{ old('expiry_date') }}" @endif>
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
