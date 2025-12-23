{{-- Show all Vendor products --}} {{-- This file is 'iclude'-ed in front/products/vendor_listing.blade.php --}} 


<!-- Row-of-Product-Container -->
<div class="row product-container grid-style">

    @foreach ($vendorProducts as $product)
        <div class="product-item col-lg-4 col-md-6 col-sm-6">
            <div class="item">
                <div class="image-container">
                    <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">

                        @php
                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                        @endphp

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
                        <a class="item-addCart" href="javascript:void(0)">Thêm vào giỏ hàng</a>
                    </div>
                </div>
                <div class="item-content">
                    <div class="what-product-is">
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                            </li>
                            <li class="has-separator">
                                <a href="listing.html">{{ $product['product_color'] }}</a>
                            </li>
                            <li>
                                <a href="listing.html">{{ $product['brand']['name'] }}</a>
                            </li>
                        </ul>
                        <h6 class="item-title">
                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                        </h6>
                        <div class="item-description">
                            <p>{{ $product['description'] }}</p>
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

                @php
                    $isProductNew = \App\Models\Product::isProductNew($product['id'])
                @endphp
                @if ($isProductNew == 'Yes')
                    <div class="tag new">
                        <span>MỚI</span>
                    </div>
                @endif

            </div>
        </div>
    @endforeach

</div>
<!-- Row-of-Product-Container /- -->