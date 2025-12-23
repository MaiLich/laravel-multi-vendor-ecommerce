{{-- This page is accessed from Customer Login tab in the dropdown menu in the header (in front/layout/header.blade.php) --}} 
@extends('front.layout.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Tài khoản</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{ url('login-register') }}">Tài khoản</a>
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
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Đăng nhập</h2>
                        <h6 class="account-h6 u-s-m-b-30">Chào mừng trở lại! Vui lòng đăng nhập vào tài khoản của bạn.</h6>

                        <p id="login-error"></p>
                        <form id="loginForm" action="javascript:;" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="users-email" class="text-field" placeholder="Nhập email" name="email">
                                <p id="login-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-password">Mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="users-password" class="text-field" placeholder="Nhập mật khẩu" name="password">
                                <p id="login-password"></p>
                            </div>

                            <div class="group-inline u-s-m-b-30">
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="{{ url('user/forgot-password') }}">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Quên mật khẩu?
                                        </a>
                                    </div>
                                </div>
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
                        <h2 class="account-h2 u-s-m-b-20">Đăng ký</h2>
                        <h6 class="account-h6 u-s-m-b-30">Đăng ký tài khoản để theo dõi trạng thái đơn hàng và lịch sử mua sắm.</h6>

                        <p id="register-success"></p>

                        <form id="registerForm" action="javascript:;" method="post">
                            @csrf

                            <div class="u-s-m-b-30">
                                <label for="username">Họ và tên
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="Nhập họ và tên" name="name">
                                <p id="register-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="usermobile">Số điện thoại
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-mobile" class="text-field" placeholder="Nhập số điện thoại" name="mobile">
                                <p id="register-mobile"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="useremail">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-email" class="text-field" placeholder="Nhập email" name="email">
                                <p id="register-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="userpassword">Mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="user-password" class="text-field" placeholder="Nhập mật khẩu" name="password">
                                <p id="register-password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="accept">
                                <label class="label-text no-color" for="accept">Tôi đã đọc và đồng ý với
                                    <a href="terms-and-conditions.html" class="u-c-brand">điều khoản & điều kiện</a>
                                </label>
                                <p id="register-accept"></p>
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