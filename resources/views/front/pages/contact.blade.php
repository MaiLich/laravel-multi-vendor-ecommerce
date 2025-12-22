{{-- This page is rendered by contact() method inside Front/CmsController.php --}}
@extends('front.layout.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Liên hệ với chúng tôi</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{ url('contact') }}">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Contact-Page -->
    <div class="page-contact u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="touch-wrapper">
                        <h1 class="contact-h1">Gửi tin nhắn cho chúng tôi</h1>

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

                                @php
                                    echo implode('', $errors->all('<div>:message</div>'))
                                @endphp

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

                        <form action="{{ url('contact') }}" method="post">
                            @csrf

                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="contact-name">Họ và tên
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="contact-name" class="text-field" placeholder="Nhập họ và tên" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="group-2">
                                    <label for="contact-email">Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="email" id="contact-email" class="text-field" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="contact-subject">Tiêu đề
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="contact-subject" class="text-field" placeholder="Nhập tiêu đề" name="subject" value="{{ old('subject') }}">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="contact-message">Nội dung tin nhắn
                                    <span class="astk">*</span>
                                </label>
                                <textarea class="text-area" id="contact-message" name="message" placeholder="Viết nội dung tin nhắn của bạn...">{{ old('message') }}</textarea>
                            </div>
                            <div class="u-s-m-b-30">
                                <button type="submit" class="button button-outline-secondary">Gửi tin nhắn</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="information-about-wrapper">
                        <h1 class="contact-h1">Thông tin về chúng tôi</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, tempora, voluptate. Architecto aspernatur, culpa cupiditate deserunt dolore eos facere in, incidunt omnis quae quam quos, similique sunt tempore vel vero.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, tempora, voluptate. Architecto aspernatur, culpa cupiditate deserunt dolore eos facere in, incidunt omnis quae quam quos, similique sunt tempore vel vero.
                        </p>
                    </div>
                    <div class="contact-us-wrapper">
                        <h1 class="contact-h1">Liên hệ</h1>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Địa chỉ</h6>
                            <span>10 Salah Salem St.</span>
                            <span>Cairo, Egypt</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Email</h6>
                            <span>developers@computerscience.com</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Điện thoại</h6>
                            <span>+201122237359</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-s-p-t-80">
            <div id="map"></div>
        </div>
    </div>
    <!-- Contact-Page /- -->
@endsection