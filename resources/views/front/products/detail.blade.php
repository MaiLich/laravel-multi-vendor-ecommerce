{{-- Note: front/products/detail.blade.php là trang được mở khi bạn nhấp vào một sản phẩm ở trang chủ FRONT --}}
{{-- $productDetails, categoryDetails và $totalStock được truyền từ phương thức detail() trong Front/ProductsController.php --}}
@extends('front.layout.layout')

@section('content')
    {{-- Đánh giá sao (của sản phẩm) (trong tab "Đánh giá") --}}
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:inherit;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>

    <!-- Phần giới thiệu trang -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Chi tiết sản phẩm</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:;">Chi tiết sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kết thúc phần giới thiệu -->

    <!-- Trang chi tiết sản phẩm -->
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">

                    {{-- Plugin EasyZoom để phóng to hình ảnh sản phẩm khi di chuột --}}
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                        <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}">
                            <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" alt="{{ $productDetails['product_name'] }}" width="500" height="500" />
                        </a>
                    </div>

                    <div class="thumbnails" style="margin-top: 30px">
                        <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}">
                            <img src="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}" width="120" height="120" alt="{{ $productDetails['product_name'] }}" />
                        </a>

                        {{-- Hiển thị hình ảnh phụ của sản phẩm --}}
                        @foreach ($productDetails['images'] as $image)
                            <a href="{{ asset('front/images/product_images/large/' . $image['image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}">
                                <img src="{{ asset('front/images/product_images/small/' . $image['image']) }}" width="120" height="120" alt="{{ $productDetails['product_name'] }}" />
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="all-information-wrapper">
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
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Thành công:</strong> @php echo Session::get('success_message') @endphp
                                <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="section-1-title-breadcrumb-rating">
                            <div class="product-title">
                                <h1>
                                    <a href="javascript:;">{{ $productDetails['product_name'] }}</a>
                                </h1>
                            </div>

                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="{{ url('/') }}">Trang chủ</a>
                                </li>
                                <li class="has-separator">
                                    <a href="javascript:;">{{ $productDetails['section']['name'] }}</a>
                                </li>
                                @php echo $categoryDetails['breadcrumbs'] @endphp
                            </ul>

                            <div class="product-rating">
                                <div title="{{ $avgRating }} trên 5 - dựa trên {{ count($ratings) }} đánh giá">
                                    @if ($avgStarRating > 0)
                                        @php
                                            $star = 1;
                                            while ($star <= $avgStarRating):
                                        @endphp
                                                <span style="color: gold; font-size: 17px">&#9733;</span>
                                        @php
                                                $star++;
                                            endwhile;
                                        @endphp
                                        ({{ $avgRating }})
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="section-2-short-description u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Mô tả sản phẩm:</h6>
                            <p>{{ $productDetails['description'] }}</p>
                        </div>

                        <div class="section-3-price-original-discount u-s-p-y-14">
                            @php $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']) @endphp
                            <span class="getAttributePrice">
                                @if ($getDiscountPrice > 0)
                                    <div class="price">
                                        <h4>{{ number_format($getDiscountPrice, 0, ',', '.') }}₫</h4>
                                    </div>
                                    <div class="original-price">
                                        <span>Giá gốc:</span>
                                        <span>{{ number_format($productDetails['product_price'], 0, ',', '.') }}₫</span>
                                    </div>
                                    <div class="discount-price">
                                        <span>Tiết kiệm:</span>
                                        <span>{{ number_format($productDetails['product_price'] - $getDiscountPrice, 0, ',', '.') }}₫</span>
                                    </div>
                                @else
                                    <div class="price">
                                        <h4>{{ number_format($productDetails['product_price'], 0, ',', '.') }}₫</h4>
                                    </div>
                                @endif
                            </span>
                        </div>

                        <div class="section-4-sku-information u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Thông tin sản phẩm:</h6>
                            <div class="left">
                                <span>Mã sản phẩm:</span>
                                <span>{{ $productDetails['product_code'] }}</span>
                            </div>
                            <div class="left">
                                <span>Màu sắc:</span>
                                <span>{{ $productDetails['product_color'] }}</span>
                            </div>
                            <div class="availability">
                                <span>Tình trạng:</span>
                                @if ($totalStock > 0)
                                    <span>Còn hàng</span>
                                @else
                                    <span style="color: red">Hết hàng</span>
                                @endif
                            </div>

                            @if ($totalStock > 0)
                                <div class="left">
                                    <span>Còn lại:</span>
                                    <span>{{ $totalStock }} sản phẩm</span>
                                </div>
                            @endif
                        </div>

                        @if(isset($productDetails['vendor']))
                            <div>
                                Bán bởi: <a href="/products/{{ $productDetails['vendor']['id'] }}">
                                            {{ $productDetails['vendor']['vendorbusinessdetails']['shop_name'] }}
                                        </a>
                            </div>
                        @endif

                        <form action="{{ url('cart/add') }}" method="Post" class="post-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                            <div class="section-5-product-variants u-s-p-y-14">
                                @if (count($groupProducts) > 0)
                                    <div>
                                        <div><strong>Các màu khác</strong></div>
                                        <div style="margin-top: 10px">
                                            @foreach ($groupProducts as $product)
                                                <a href="{{ url('product/' . $product['id']) }}">
                                                    <img style="width: 80px" src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}" alt="{{ $product['product_name'] }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="sizes u-s-m-b-11" style="margin-top: 20px">
                                    <span>Kích cỡ:</span>
                                    <div class="size-variant select-box-wrapper">
                                        <select class="select-box product-size" id="getPrice" product-id="{{ $productDetails['id'] }}" name="size" required>
                                            <option value="">Chọn kích cỡ</option>
                                            @foreach ($productDetails['attributes'] as $attribute)
                                                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                <div class="quantity-wrapper u-s-m-b-22">
                                    <span>Số lượng:</span>
                                    <div class="quantity">
                                        <input class="quantity-text-field" type="number" name="quantity" value="1" min="1">
                                    </div>
                                </div>
                                <div>
                                    <button class="button button-outline-secondary" type="submit">Thêm vào giỏ hàng</button>
                                    <button class="button button-outline-secondary far fa-heart u-s-m-l-6" title="Yêu thích"></button>
                                    <button class="button button-outline-secondary far fa-envelope u-s-m-l-6" title="Chia sẻ"></button>
                                </div>
                            </div>
                        </form>

                        <!-- <br><br><b>Giao hàng</b>
                        <input type="text" id="pincode" placeholder="Nhập mã vùng giao hàng">
                        <button type="button" id="checkPincode">Kiểm tra</button> -->
                    </div>
                </div>
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#detail">Chi tiết sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#review">Đánh giá ({{ count($ratings) }})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#policy">Chính sách đổi trả</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="detail">
                                <div class="specification-whole-container">
                                    <div class="spec-table u-s-m-b-50">
                                        <h4 class="spec-heading">Thông tin chi tiết</h4>
                                        <table>
                                            @php
                                                $productFilters = \App\Models\ProductsFilter::productFilters(); 
                                            @endphp

                                            @foreach ($productFilters as $filter)
                                                @if (isset($productDetails['category_id']))
                                                    @php
                                                        $filterAvailable = \App\Models\ProductsFilter::filterAvailable($filter['id'], $productDetails['category_id']);
                                                    @endphp

                                                    @if ($filterAvailable == 'Yes')
                                                        <tr>
                                                            <td>{{ $filter['filter_name'] }}</td>
                                                            <td>
                                                                @foreach ($filter['filter_values'] as $value)
                                                                    @if (!empty($productDetails[$filter['filter_column']]) && $productDetails[$filter['filter_column']] == $value['filter_value'])
                                                                        {{ ucwords($value['filter_value']) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="review">
                                <div class="review-whole-container">
                                    <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-score-wrapper">
                                                <h6 class="review-h6">Đánh giá trung bình</h6>
                                                <div class="circle-wrapper">
                                                    <h1>{{ $avgRating }}</h1>
                                                </div>
                                                <h6 class="review-h6">Dựa trên {{ count($ratings) }} lượt đánh giá</h6>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-star-meter">
                                                <div class="star-wrapper"><span>5 sao</span><span>({{ $ratingFiveStarCount }})</span></div>
                                                <div class="star-wrapper"><span>4 sao</span><span>({{ $ratingFourStarCount }})</span></div>
                                                <div class="star-wrapper"><span>3 sao</span><span>({{ $ratingThreeStarCount }})</span></div>
                                                <div class="star-wrapper"><span>2 sao</span><span>({{ $ratingTwoStarCount }})</span></div>
                                                <div class="star-wrapper"><span>1 sao</span><span>({{ $ratingOneStarCount }})</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="get-reviews u-s-p-b-22">
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Đánh giá <span> ({{ count($ratings) }}) </span></h6>
                                            </div>
                                        </div>

                                        <div class="reviewers">
                                            @if (count($ratings) > 0)
                                                @foreach($ratings as $rating)
                                                    <div class="review-data">
                                                        <div class="reviewer-name-and-date">
                                                            <h6 class="reviewer-name">{{ $rating['user']['name'] }}</h6>
                                                            <h6 class="review-posted-date">{{ date('d/m/Y H:i', strtotime($rating['created_at'])) }}</h6>
                                                        </div>
                                                        <div class="reviewer-stars-title-body">
                                                            <div class="reviewer-stars">
                                                                @php
                                                                    $count = 0;
                                                                    while ($count < $rating['rating']):
                                                                @endphp
                                                                    <span style="color: gold">&#9733;</span>
                                                                @php
                                                                        $count++;
                                                                    endwhile;
                                                                @endphp
                                                            </div>
                                                            <p class="review-body">{{ $rating['review'] }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="policy">
                                <div class="description-whole-container">
                                    <h4 class="u-s-m-b-16">Chính sách đổi trả</h4>
                                    <ul style="line-height: 1.8;">
                                        <li>- Mức phí: <strong>30,000₫ nội thành</strong> và <strong>40,000₫ ngoại thành</strong></li>
                                        <li>- Được kiểm tra hàng trước khi nhận hàng</li>
                                        <li>- Đổi hàng trong vòng <strong>30 ngày</strong> kể từ khi nhận hàng</li>
                                        <li>- Không áp dụng đổi/trả sản phẩm trong chương trình khuyến mãi</li>
                                        <li>- <strong>Miễn phí đổi trả</strong> nếu lỗi sai sót từ phía chúng tôi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->

            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar-Products -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Sản phẩm tương tự</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($similarProducts as $product)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                @php
                                                    $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                                @endphp
                                                @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                    <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                @else
                                                    <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="{{ $product['product_name'] }}">
                                                @endif
                                            </a>

                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                <a class="item-addCart" href="javascript:void(0)">Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>

                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="javascript:void(0)">{{ $product['product_code'] }}</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="javascript:void(0)">{{ $product['product_color'] }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">{{ $product['brand']['name'] ?? '' }}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                </h6>
                                            </div>

                                            @php
                                                $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                            @endphp

                                            @if ($getDiscountPrice > 0)
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ number_format($getDiscountPrice, 0, ',', '.') }}₫
                                                    </div>
                                                    <div class="item-old-price">
                                                        {{ number_format($product['product_price'], 0, ',', '.') }}₫
                                                    </div>
                                                </div>
                                            @else
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ number_format($product['product_price'], 0, ',', '.') }}₫
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="tag new">
                                            <span>MỚI</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Similar-Products /- -->

                <!-- Recently-View-Products  -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Sản phẩm bạn đã xem gần đây</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($recentlyViewedProducts as $product)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                @php
                                                    $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                                @endphp
                                                @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                    <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                @else
                                                    <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="{{ $product['product_name'] }}">
                                                @endif
                                            </a>

                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                <a class="item-addCart" href="javascript:void(0)">Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>

                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="javascript:void(0)">{{ $product['product_code'] }}</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="javascript:void(0)">{{ $product['product_color'] }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">{{ $product['brand']['name'] ?? '' }}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                </h6>
                                            </div>

                                            @php
                                                $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                            @endphp

                                            @if ($getDiscountPrice > 0)
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ number_format($getDiscountPrice, 0, ',', '.') }}₫
                                                    </div>
                                                    <div class="item-old-price">
                                                        {{ number_format($product['product_price'], 0, ',', '.') }}₫
                                                    </div>
                                                </div>
                                            @else
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ number_format($product['product_price'], 0, ',', '.') }}₫
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="tag new">
                                            <span>MỚI</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Recently-View-Products /- -->
            </div>
            <!-- Different-Product-Section /- -->
        </div>
    </div>
    <!-- Single-Product-Full-Width-Page /- -->
@endsection