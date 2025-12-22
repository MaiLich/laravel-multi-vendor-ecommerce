{{-- This page is accessed from Vendor Login tab in the drop-down menu in the header (in front/layout/header.blade.php) --}} 
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Tài khoản nhà bán hàng</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:;">Tài khoản nhà bán hàng</a>
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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Lỗi:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Đăng nhập (Nhà bán hàng)</h2>
                        <h6 class="account-h6 u-s-m-b-30">Chào mừng quay lại! Đăng nhập vào tài khoản của bạn.</h6>

                        <form action="{{ url('admin/login') }}" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="vendor-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" name="email" id="vendor-email" class="text-field" placeholder="Nhập email">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendor-password">Mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" name="password" id="vendor-password" class="text-field" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Đăng ký (Nhà bán hàng)</h2>
                        <h6 class="account-h6 u-s-m-b-30">Đăng ký để trở thành nhà bán hàng trên hệ thống của chúng tôi.</h6>

                        <form id="vendorForm" action="{{ url('/vendor/register') }}" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="vendorname">Họ và tên
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="vendorname" class="text-field" placeholder="Họ và tên" name="name">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendormobile">Số điện thoại
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="vendormobile" class="text-field" placeholder="Số điện thoại" name="mobile">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendoremail">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="vendoremail" class="text-field" placeholder="Email" name="email">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendorpassword">Mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="vendorpassword" class="text-field" placeholder="Mật khẩu" name="password">
                            </div>

                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="accept">
                                <label class="label-text no-color" for="accept">Tôi đã đọc và đồng ý với
                                    <a href="terms-and-conditions.html" class="u-c-brand">điều khoản & điều kiện</a>
                                </label>
                            </div>

                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection