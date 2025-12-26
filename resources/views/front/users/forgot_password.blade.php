{{-- User Forgot Password Functionality --}}
{{-- This page is accessed from the <a> tag in front/users/login_register.blade.php --}}
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
                        <a href="javascript:;">Tài khoản</a>
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
                <!-- Forgot Password -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Quên mật khẩu?</h2>
                        <h6 class="account-h6 u-s-m-b-30">Nhập email của bạn để khôi phục mật khẩu.</h6>
                      
                        <p id="forgot-error"></p>
                        <p id="forgot-success"></p>
                        <form id="forgotForm" action="javascript:;" method="post">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="users-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" name="email" id="users-email" class="text-field" placeholder="Nhập email của bạn">
                                <p id="forgot-email"></p>
                            </div>
                            <div class="group-inline u-s-m-b-30">
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="{{ url('user/login-register') }}">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Quay lại đăng nhập
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-45">
                                <button type="submit" class="button button-outline-secondary w-100">Gửi yêu cầu</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Forgot Password /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Đăng ký</h2>
                        <h6 class="account-h6 u-s-m-b-30">Đăng ký tài khoản để theo dõi đơn hàng và lịch sử mua sắm.</h6>
                      
                        <p id="register-success"></p>
                      
                        <form id="registerForm" action="javascript:;" method="post">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="user-name">Họ và tên
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="Họ và tên" name="name">
                                <p id="register-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-mobile">Số điện thoại
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-mobile" class="text-field" placeholder="Số điện thoại" name="mobile">
                                <p id="register-mobile"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-email" class="text-field" placeholder="Email" name="email">
                                <p id="register-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-password">Mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="user-password" class="text-field" placeholder="Mật khẩu" name="password">
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