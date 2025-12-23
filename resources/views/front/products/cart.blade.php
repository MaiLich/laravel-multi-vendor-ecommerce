{{-- Note: cart.blade.php is the page that opens when you ... --}}
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
                        <a href="{{ url('cart') }}">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
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
                <div class="col-lg-12">

                    <div id="appendCartItems">
                        @include('front.products.cart_items')
                    </div>

                    <!-- Coupon -->
                    <div class="coupon-continue-checkout u-s-m-b-60">
                        <div class="coupon-area">
                            <h6>Nếu bạn có mã giảm giá, hãy nhập vào đây.</h6>
                            <div class="coupon-field">

                                <form id="applyCoupon" method="post" action="javascript:void(0)"  @if (\Illuminate\Support\Facades\Auth::check()) user=1 @endif>
                                    <label class="sr-only" for="coupon-code">Áp dụng mã giảm giá</label>
                                    <input type="text" class="text-field" placeholder="Nhập mã giảm giá" id="code" name="code">
                                    <button type="submit" class="button">Áp dụng</button>
                                </form>

                            </div>
                        </div>
                        <div class="button-area">
                            <a href="{{ url('/') }}" class="continue">Tiếp tục mua sắm</a>
                            <a href="{{ url('/checkout') }}" class="checkout">Tiến hành thanh toán</a>
                        </div>
                    </div>
                    <!-- Coupon /- -->

                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection