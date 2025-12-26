{{-- This page is rendered by the success() method inside Front/PaypalController.php (if making the order PayPal payment is successful) --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Thanh toán</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Cảm ơn</a>
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
                    <h3>Thanh toán của bạn đã được xác nhận</h3>
                    <p>Cảm ơn quý khách đã thanh toán. Chúng tôi sẽ xử lý đơn hàng của quý khách trong thời gian sớm nhất.</p>
                    <p>Mã đơn hàng của quý khách là <strong>{{ Session::get('order_id') }}</strong> và tổng số tiền đã thanh toán là <strong>{{ number_format(Session::get('grand_total'), 0, ',', '.') }}₫</strong></p> 
                    {{-- The Order Number is the order `id` in the `orders` database table. We stored the order id in Session in checkout() method in Front/ProductsController.php --}} 
                    {{-- Retrieving Data: https://laravel.com/docs/10.x/session#retrieving-data --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection



{{-- Forget/Remove some data in the Session after making the PayPal payment --}} 
@php
    use Illuminate\Support\Facades\Session;

    Session::forget('grand_total');  // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('order_id');     // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
    Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
@endphp