{{-- This page is rendered by iyzipay() method inside Front/IyzipayController.php --}}


@extends('front.layout.layout')



@section('content')

    <style>
        .button {
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        }
        
        .button1 {background-color: #4CAF50;} /* Green */
        .button2 {background-color: #008CBA;} /* Blue */
    </style>



    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Giỏ hàng</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Trang chủ</a>
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
                    <h3>VUI LÒNG THANH TOÁN <span style="color: red">INR {{ Session::get('grand_total') }}</span> CHO ĐƠN HÀNG CỦA BẠN</h3>
                    <a href="{{ url('iyzipay/pay') }}">
                        <button class="button button2">Thanh toán ngay</button> {{-- Interacting With The Session: Retrieving Data: https://laravel.com/docs/9.x/session#retrieving-data --}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection
