{{-- This page is rendered by index() method in Front/IndexController.php --}}
@extends('front.layout.layout')

@section('content')
    <!-- Main-Slider -->
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">

            {{-- Show the banner dynamically depending on the Admin Panel choice --}} 
            @foreach ($sliderBanners as $banner)
                <div class="bg-image">
                    <div class="slide-content">
                        <h1>
                            <a @if (!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:;" @endif>
                                <img src="{{ asset('front/images/banner_images/' . $banner['image']) }}" title="{{ $banner['title'] }}" alt="{{ $banner['title'] }}">
                            </a>
                        </h1>
                        <h2>{{ $banner['title'] }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Main-Slider /- -->

    @if (isset($fixBanners[1]['image']))
        <!-- Banner-Layer -->
        <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
        <!-- Banner-Layer /- -->    
    @endif

    <!-- Top Collection -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">BỘ SƯU TẬP NỔI BẬT</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#men-latest-products">Sản phẩm mới</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Bán chạy nhất</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#discounted-products">Sản phẩm giảm giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">Nổi bật</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="men-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    @foreach ($newProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Không có hình ảnh sản phẩm">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                    <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 trên 5 - dựa trên 0 đánh giá">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }}đ
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $product['product_price'] }}đ
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $product['product_price'] }}đ
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
                        <div class="tab-pane show fade" id="men-best-selling-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    @foreach ($bestSellers as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Không có hình ảnh sản phẩm">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                    <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 trên 5 - dựa trên 0 đánh giá">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                    {{ $getDiscountPrice }}đ
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $product['product_price'] }}đ
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $product['product_price'] }}đ
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
                        <div class="tab-pane fade" id="discounted-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    @foreach ($discountedProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Không có hình ảnh sản phẩm">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                    <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 trên 5 - dựa trên 0 đánh giá">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }}đ
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $product['product_price'] }}đ
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $product['product_price'] }}đ
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
                        <div class="tab-pane fade" id="men-featured-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    @foreach ($featuredProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['product_name'] }}">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Không có hình ảnh sản phẩm">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Xem nhanh</a>
                                                    <a class="item-mail" href="javascript:void(0)">Gửi email</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Thêm vào yêu thích</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 trên 5 - dựa trên 0 đánh giá">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }}đ
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $product['product_price'] }}đ
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $product['product_price'] }}đ
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Collection /- -->

    @if (isset($fixBanners[1]['image']))
        <!-- Banner-Layer -->
        <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
        <!-- Banner-Layer /- -->    
    @endif

    <!-- Site-Priorities -->
    <section class="app-priority">
        <div class="container">
            <div class="priority-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-star"></i>
                            </div>
                            <h2>
                                Giá trị tuyệt vời
                            </h2>
                            <p>Chúng tôi cung cấp giá cạnh tranh cho hơn 100 triệu sản phẩm</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-cash"></i>
                            </div>
                            <h2>
                                Mua sắm an tâm
                            </h2>
                            <p>Chính sách bảo vệ của chúng tôi bảo vệ đơn hàng từ lúc đặt đến khi giao hàng</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-ios-card"></i>
                            </div>
                            <h2>
                                Thanh toán an toàn
                            </h2>
                            <p>Thanh toán bằng các phương thức phổ biến và an toàn nhất thế giới</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-contacts"></i>
                            </div>
                            <h2>
                                Hỗ trợ 24/7
                            </h2>
                            <p>Hỗ trợ liên tục để mang lại trải nghiệm mua sắm mượt mà</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Site-Priorities /- -->
@endsection