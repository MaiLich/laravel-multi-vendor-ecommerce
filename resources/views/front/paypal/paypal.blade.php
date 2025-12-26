{{-- This page is rendered by paypal() method inside Front/PaypalController.php --}}
@extends('front.layout.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Giỏ hàng</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Tiến hành thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" align="center">
                    <h3>VUI LÒNG THANH TOÁN ĐƠN HÀNG CỦA BẠN</h3>
                    <form action="{{ route('payment') }}" method="post">
                        @csrf

                        <input type="hidden" name="amount" value="{{ round(Session::get('grand_total') / 80, 2) }}">
                        <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Thanh toán bằng PayPal">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection