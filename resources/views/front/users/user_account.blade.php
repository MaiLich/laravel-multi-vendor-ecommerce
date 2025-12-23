{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}} 
@extends('front.layout.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Tài khoản của tôi</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{ url('user/account') }}">Tài khoản</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">

            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

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
                    <strong>Lỗi:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <!-- Update User Account Contact Details -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Cập nhật thông tin liên hệ</h2>

                        <p id="account-error"></p>
                        <p id="account-success"></p>

                        <form id="accountForm" action="javascript:;" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" style="background-color: #e9e9e9" readonly disabled>
                                <p id="account-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-name">Họ và tên
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-name" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                                <p id="account-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-address">Địa chỉ
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-address" name="address" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}">
                                <p id="account-address"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-city">Thành phố
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-city" name="city" value="{{ \Illuminate\Support\Facades\Auth::user()->city }}">
                                <p id="account-city"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-state">Tỉnh / Bang
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-state" name="state" value="{{ \Illuminate\Support\Facades\Auth::user()->state }}">
                                <p id="account-state"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-country">Quốc gia
                                    <span class="astk">*</span>
                                </label>
                                <select class="text-field" id="user-country" name="country" style="color: #495057">
                                    <option value="">Chọn quốc gia</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country['country_name'] }}"  @if ($country['country_name'] == \Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                                    @endforeach

                                </select>
                                <p id="account-country"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-pincode">Mã bưu điện
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-pincode" name="pincode" value="{{ \Illuminate\Support\Facades\Auth::user()->pincode }}">
                                <p id="account-pincode"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-mobile">Số điện thoại
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" type="text" id="user-mobile" name="mobile" value="{{ \Illuminate\Support\Facades\Auth::user()->mobile }}">
                                <p id="account-mobile"></p>
                            </div>
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Update User Account Contact Details /- -->

                <!-- Update User Password via AJAX --> 
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Đổi mật khẩu</h2>

                        <p id="password-success"></p>
                        <p id="password-error"></p>

                        <form id="passwordForm" action="javascript:;" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="current-password">Mật khẩu hiện tại
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="current-password" class="text-field" placeholder="Nhập mật khẩu hiện tại" name="current_password">
                                <p id="password-current_password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="new-password">Mật khẩu mới
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="new-password" class="text-field" placeholder="Nhập mật khẩu mới" name="new_password">
                                <p id="password-new_password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="confirm-password">Xác nhận mật khẩu mới
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="confirm-password" class="text-field" placeholder="Nhập lại mật khẩu mới" name="confirm_password">
                                <p id="password-confirm_password"></p>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Update User Password via AJAX /- -->

            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection