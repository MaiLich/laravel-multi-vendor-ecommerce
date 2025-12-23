{{-- This page is rendered by orders() method inside Front/OrderController.php (depending on if the order id Optional Parameter (slug) is passed in or not) --}}
@extends('front.layout.layout')

@section('content')

{{-- ⭐ CSS tổng thể --}}
<style>
    body {
        background-color: #f8f9fa;
        color: #222;
    }

    .page-intro h2 {
        color: #333333ff;
        font-weight: 600;
    }

    .table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }

    .table th, .table td {
        vertical-align: middle !important;
        border-color: #ddd !important;
    }

    .table thead th {
        background-color: #333333ff;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-title {
        background: #333333ff;
        color: #fff;
        padding: 10px 15px;
        font-weight: 600;
        font-size: 16px;
        border-radius: 6px 6px 0 0;
    }

    .btn {
        border-radius: 4px;
        font-size: 14px;
        padding: 6px 12px;
        transition: all 0.2s ease-in-out;
    }

    .btn-outline-primary {
        color: #333333ff;
        border: 1px solid #333333ff;
    }

    .btn-outline-primary:hover {
        background: #333333ff;
        color: #fff;
    }

    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 30px rgba(0,0,0,0.2);
    }

    .modal-header {
        background-color: #333333ff;
        color: #fff !important;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }

    .modal-title {
        color: #fff !important;
        font-weight: 400;
        letter-spacing: 0.3px;
    }
    
    .modal-body {
        background-color: #fff;
        padding: 30px;
    }

    .btn-submit-rating {
        background-color: #333333ff;
        color: #fff;
        border: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-submit-rating:hover {
        background-color: #333;
    }

    /* ⭐ Đánh giá sao */
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position: absolute;
        top: -9999px;
        left: -9999px;
        visibility: hidden;
    }
    .rate:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc; /* màu sao mặc định */
        transition: color 0.2s ease;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700; /* sao được chọn */
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #ffcc00; /* sao vàng sáng khi hover */
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #ffdb4d; /* vàng sáng hơn khi hover trên sao đã chọn */
    }
</style>

<!-- Tiêu đề trang -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro text-center">
            <h2>Chi tiết đơn hàng #{{ $orderDetails['id'] }}</h2>
            <ul class="bread-crumb d-inline-flex justify-content-center">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Trang chủ</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('user/orders') }}">Đơn hàng của tôi</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Tiêu đề -->

<!-- Nội dung -->
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">

        {{-- ⭐ Thông báo nổi (toast như các trang TMĐT) --}}
        @if (Session::has('error_message') || Session::has('success_message'))
            <div id="toast-message" 
                style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 280px; border-radius: 8px; 
                    padding: 15px 20px; color: #000000ff; display: flex; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2); 
                    animation: fadeInOut 5s ease forwards;
                    @if(Session::has('error_message'))
                        background-color: #7388ffff; 
                    @else
                        background-color: #333333ff;
                    @endif">
                <i class="fa 
                    @if(Session::has('error_message')) fa-exclamation-circle 
                    @else fa-check-circle 
                    @endif" 
                    style="font-size: 20px; margin-right: 10px; color: #ffffffff;"></i>
                <div style="flex: 1;">
                    @php
                        $message = Session::has('error_message') ? Session::get('error_message') : Session::get('success_message');
                        if (stripos($message, 'already rated') !== false) {
                            $message = 'Bạn đã đánh giá sản phẩm này trước đó!';
                        }
                    @endphp
                    <strong>
                        @if (Session::has('error_message'))
                            Lỗi:
                        @else
                            Thành công:
                        @endif
                    </strong>
                    <div>{{ $message }}</div>
                </div>
                <button type="button" onclick="this.parentElement.style.display='none'" 
                        style="background: none; border: none; color: #fff; font-size: 18px; margin-left: 10px; cursor: pointer;">&times;</button>
            </div>

            {{-- Hiệu ứng tự ẩn --}}
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toast-message');
                    if (toast) toast.style.display = 'none';
                }, 5000);
            </script>

            {{-- Hiệu ứng mượt mà --}}
            <style>
                @keyframes fadeInOut {
                    0% {opacity: 0; transform: translateY(-10px);}
                    10%, 90% {opacity: 1; transform: translateY(0);}
                    100% {opacity: 0; transform: translateY(-10px);}
                }
            </style>
        @endif



            {{-- Thông tin đơn hàng --}}
            <div class="table-title">Thông tin đơn hàng</div>
            <table class="table table-striped table-borderless">
                <tr><td>Ngày đặt hàng</td><td>{{ date('Y-m-d H:i:s', strtotime($orderDetails['created_at'])) }}</td></tr>
                <tr><td>Trạng thái đơn hàng</td><td>{{ $orderDetails['order_status'] }}</td></tr>
                <tr><td>Tổng tiền hàng</td><td>{{ $orderDetails['grand_total'] }}đ</td></tr>
                <tr><td>Phí vận chuyển</td><td>{{ $orderDetails['shipping_charges'] }}đ</td></tr>

                @if (!empty($orderDetails['coupon_code']))
                    <tr><td>Mã giảm giá</td><td>{{ $orderDetails['coupon_code'] }}</td></tr>
                    <tr><td>Số tiền giảm</td><td>{{ $orderDetails['coupon_amount'] }}đ</td></tr>
                @endif

                @if (!empty($orderDetails['courier_name']))
                    <tr><td>Đơn vị vận chuyển</td><td>{{ $orderDetails['courier_name'] }}</td></tr>
                    <tr><td>Mã vận đơn</td><td>{{ $orderDetails['tracking_number'] }}</td></tr>
                @endif

                <tr><td>Phương thức thanh toán</td><td>{{ $orderDetails['payment_method'] }}</td></tr>
            </table>

            {{-- Danh sách sản phẩm --}}
            <div class="table-title">Sản phẩm trong đơn hàng</div>
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Đánh giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails['orders_products'] as $product)
                        <tr>
                            <td>
                                @php
                                    $getProductImage = \App\Models\Product::getProductImage($product['product_id']);
                                @endphp
                                <a target="_blank" href="{{ url('product/' . $product['product_id']) }}">
                                    <img style="width: 80px; border-radius: 6px;" src="{{ asset('front/images/product_images/small/' . $getProductImage) }}" alt="{{ $product['product_name'] }}">
                                </a>
                            </td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_size'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>{{ $product['product_qty'] }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#ratingModal_{{ $product['product_id'] }}">
                                    <i class="fa fa-star"></i> Đánh giá
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Địa chỉ giao hàng --}}
            <div class="table-title">Địa chỉ giao hàng</div>
            <table class="table table-striped table-borderless">
                <tr><td>Họ và tên</td><td>{{ $orderDetails['name'] }}</td></tr>
                <tr><td>Địa chỉ</td><td>{{ $orderDetails['address'] }}</td></tr>
                <tr><td>Thành phố</td><td>{{ $orderDetails['city'] }}</td></tr>
                <tr><td>Tỉnh / Bang</td><td>{{ $orderDetails['state'] }}</td></tr>
                <tr><td>Quốc gia</td><td>{{ $orderDetails['country'] }}</td></tr>
                <tr><td>Mã bưu điện</td><td>{{ $orderDetails['pincode'] }}</td></tr>
                <tr><td>Số điện thoại</td><td>{{ $orderDetails['mobile'] }}</td></tr>
            </table>
        </div>
    </div>
</div>

{{-- ⭐ MODAL POPUP ĐÁNH GIÁ --}}
@foreach ($orderDetails['orders_products'] as $product)
<div class="modal fade" id="ratingModal_{{ $product['product_id'] }}" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel_{{ $product['product_id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel_{{ $product['product_id'] }}">
                    Đánh giá sản phẩm: {{ $product['product_name'] }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ url('add-rating') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['product_id'] }}">

                    <div class="text-center mb-3">
                        @php
                            $getProductImage = \App\Models\Product::getProductImage($product['product_id']);
                        @endphp
                        <img style="width: 120px; border-radius: 8px;" src="{{ asset('front/images/product_images/small/' . $getProductImage) }}" alt="{{ $product['product_name'] }}">
                    </div>

                    <div class="form-group text-center">
                        <div class="rate">
                            <input type="radio" id="star5_{{ $product['product_id'] }}" name="rating" value="5" />
                            <label for="star5_{{ $product['product_id'] }}" title="Tuyệt vời - 5 sao">5 sao</label>

                            <input type="radio" id="star4_{{ $product['product_id'] }}" name="rating" value="4" />
                            <label for="star4_{{ $product['product_id'] }}" title="Tốt - 4 sao">4 sao</label>

                            <input type="radio" id="star3_{{ $product['product_id'] }}" name="rating" value="3" />
                            <label for="star3_{{ $product['product_id'] }}" title="Trung bình - 3 sao">3 sao</label>

                            <input type="radio" id="star2_{{ $product['product_id'] }}" name="rating" value="2" />
                            <label for="star2_{{ $product['product_id'] }}" title="Không tốt - 2 sao">2 sao</label>

                            <input type="radio" id="star1_{{ $product['product_id'] }}" name="rating" value="1" />
                            <label for="star1_{{ $product['product_id'] }}" title="Tệ - 1 sao">1 sao</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="review" rows="4" placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit-rating btn-block">Gửi đánh giá</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection