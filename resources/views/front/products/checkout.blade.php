{{-- Note: This page (view) is rendered by the checkout() method in the Front/ProductsController.php --}}
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
                        <a href="#">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-80">
        <div class="container">

            {{-- Showing the following HTML Form Validation Errors: (check checkout() method in Front/ProductsController.php) --}}
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                            <!-- Billing-&-Shipping-Details -->
                            <div class="col-lg-6" id="deliveryAddresses">



                                
                                
                                @include('front.products.delivery_addresses')



                            </div>
                            <!-- Billing-&-Shipping-Details /- -->
                            <!-- Checkout -->
                            <div class="col-lg-6">



                                {{-- The complete HTML Form of the user submitting their Delivery Address and Payment Method --}}
                                <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">
                                    @csrf


                                    
                                    
                                    @if (count($deliveryAddresses) > 0)

                                        <h4 class="section-h4">Địa chỉ giao hàng</h4>

                                        @foreach ($deliveryAddresses as $address)
                                            <div class="control-group" style="float: left; margin-right: 5px">
                                                <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" shipping_charges="{{ $address['shipping_charges'] }}" total_price="{{ $total_price }}" coupon_amount="{{ \Illuminate\Support\Facades\Session::get('couponAmount') }}" codpincodeCount="{{ $address['codpincodeCount'] }}" prepaidpincodeCount="{{ $address['prepaidpincodeCount'] }}">
                                            </div>
                                            <div>
                                                <label class="control-label" for="address{{ $address['id'] }}">
                                                    {{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state'] }}, {{ $address['country'] }} ({{ $address['mobile'] }})
                                                </label>
                                                <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="removeAddress" style="float: right; margin-left: 10px">Xóa</a>
                                                <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="editAddress"   style="float: right"                   >Sửa</a>
                                            </div>
                                        @endforeach
                                        <br>
                                    @endif 


                                    <h4 class="section-h4">Đơn hàng của bạn</h4>
                                    <div class="order-table">
                                        <table class="u-s-m-b-13">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                
                                                @php $total_price = 0 @endphp

                                                @foreach ($getCartItems as $item)
                                                    @php
                                                        $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                                                    @endphp


                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('product/' . $item['product_id']) }}">
                                                                <img width="50px" src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" alt="Product">
                                                                <h6 class="order-h6">{{ $item['product']['product_name'] }}
                                                                <br>
                                                                {{ $item['size'] }} / {{ $item['product']['product_color'] }}</h6>
                                                            </a>
                                                            <span class="order-span-quantity">x {{ $item['quantity'] }}</span>
                                                        </td>
                                                        <td>
                                                            <h6 class="order-h6">{{ number_format($getDiscountAttributePrice['final_price'] * $item['quantity'], 0, ',', '.') }}₫</h6>
                                                        </td>
                                                    </tr>


                                                    
                                                    @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
                                                @endforeach


                                                <tr>
                                                    <td>
                                                        <h3 class="order-h3">Tạm tính</h3>
                                                    </td>
                                                    <td>
                                                        <h3 class="order-h3">{{ number_format($total_price, 0, ',', '.') }}₫</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="order-h6">Phí vận chuyển</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="order-h6">
                                                            <span class="shipping_charges">0₫</span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="order-h6">Giảm giá mã khuyến mãi</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="order-h6">
                                                            
                                                            @if (\Illuminate\Support\Facades\Session::has('couponAmount'))
                                                                <span class="couponAmount">{{ number_format(\Illuminate\Support\Facades\Session::get('couponAmount'), 0, ',', '.') }}₫</span>
                                                            @else
                                                                0₫
                                                            @endif
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h3 class="order-h3">Tổng thanh toán</h3>
                                                    </td>
                                                    <td>
                                                        <h3 class="order-h3">
                                                            <strong class="grand_total">{{ number_format($total_price - \Illuminate\Support\Facades\Session::get('couponAmount'), 0, ',', '.') }}₫</strong>
                                                        </h3>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                        <div class="u-s-m-b-13 codMethod">
                                            <input type="radio" class="radio-box" name="payment_gateway" id="cash-on-delivery" value="COD">
                                            <label class="label-text" for="cash-on-delivery">Thanh toán khi nhận hàng (COD)</label>
                                        </div>
                                        <div class="u-s-m-b-13 prepaidMethod">
                                            <input type="radio" class="radio-box" name="payment_gateway" id="paypal" value="Paypal">
                                            <label class="label-text" for="paypal">PayPal</label>
                                        </div>


                                        <div class="u-s-m-b-13 prepaidMethod">
                                            <input type="radio" class="radio-box" name="payment_gateway" id="iyzipay" value="iyzipay">
                                            <label class="label-text" for="iyzipay">iyzipay</label>
                                        </div>


                                        <div class="u-s-m-b-13">
                                            <input type="checkbox" class="check-box" id="accept" name="accept" value="Yes" title="Vui lòng đồng ý với điều khoản">
                                            <label class="label-text no-color" for="accept">Tôi đã đọc và đồng ý với
                                                <a href="terms-and-conditions.html" class="u-c-brand">điều khoản & điều kiện</a>
                                            </label>
                                        </div>
                                        <button type="submit" id="placeOrder" class="button button-outline-secondary">Đặt hàng</button>
                                    </div>
                                </form>


                            </div>
                            <!-- Checkout /- -->
                        </div>

                    </div>
                </div>


        </div>
    </div>
    <!-- Checkout-Page /- -->
@endsection