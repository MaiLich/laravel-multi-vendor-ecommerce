{{-- Modal Popup --}} 


<!-- Dummy Selectbox -->
<div class="select-dummy-wrapper">
    <select id="compute-select">
        <option id="compute-option">Tất cả</option>
    </select>
</div>
<!-- Dummy Selectbox /- -->
<!-- Responsive-Search -->
<div class="responsive-search-wrapper">
    <button type="button" class="button ion ion-md-close" id="responsive-search-close-button"></button>
    <div class="responsive-search-container">
        <div class="container">
            <p>Bắt đầu gõ và nhấn Enter để tìm kiếm</p>
            <form class="responsive-search-form">
                <label class="sr-only" for="search-text">Tìm kiếm</label>
                <input id="search-text" type="text" class="responsive-search-field" placeholder="VUI LÒNG TÌM KIẾM">
                <i class="fas fa-search"></i>
            </form>
        </div>
    </div>
</div>
<!-- Responsive-Search /- -->
<!-- Newsletter-Modal -->




<!-- Newsletter-Modal /- -->
<!-- Quick-view-Modal -->
<div id="quick-view" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <!-- Product-zoom-area -->
                        <div class="zoom-area">
                            <img id="zoom-pro-quick-view" class="img-fluid" src="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}" alt="Zoom Image">
                            <div id="gallery-quick-view" class="u-s-m-t-10">
                                <a class="active" data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                                <a data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                                <a data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                                <a data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                                <a data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                                <a data-image="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}">
                                <img src="{{ asset('front/images/product/product@2x.jpg') }}" alt="Product">
                                </a>
                            </div>
                        </div>
                        <!-- Product-zoom-area /- -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <!-- Product-details -->
                        <div class="all-information-wrapper">
                            <div class="section-1-title-breadcrumb-rating">
                                <div class="product-title">
                                    <h1>
                                        <a href="single-product.html">Tên sản phẩm</a>
                                    </h1>
                                </div>
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="index.html">Trang chủ</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Thời trang Nam</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="listing.html">Áo</a>
                                    </li>
                                    <li class="is-marked">
                                        <a href="shop-v3-sub-sub-category.html">Áo hoodie</a>
                                    </li>
                                </ul>
                                <div class="product-rating">
                                    <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                        <span style='width:67px'></span>
                                    </div>
                                    <span>(23)</span>
                                </div>
                            </div>
                            <div class="section-2-short-description u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Mô tả:</h6>
                                <p>Mô tả sản phẩm mẫu...</p>
                            </div>
                            <div class="section-3-price-original-discount u-s-p-y-14">
                                <div class="price">
                                    <h4>{{ number_format(1000000, 0, ',', '.') }}₫</h4>
                                </div>
                                <div class="original-price">
                                    <span>Giá gốc:</span>
                                    <span>{{ number_format(1200000, 0, ',', '.') }}₫</span>
                                </div>
                                <div class="discount-price">
                                    <span>Giảm:</span>
                                    <span>15%</span>
                                </div>
                                <div class="total-save">
                                    <span>Tiết kiệm:</span>
                                    <span>{{ number_format(200000, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                            <div class="section-4-sku-information u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Thông tin sản phẩm:</h6>
                                <div class="availability">
                                    <span>Tình trạng:</span>
                                    <span>Còn hàng</span>
                                </div>
                                <div class="left">
                                    <span>Chỉ còn:</span>
                                    <span>50 sản phẩm</span>
                                </div>
                            </div>
                            <div class="section-5-product-variants u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Tùy chọn sản phẩm:</h6>
                                <div class="color u-s-m-b-11">
                                    <span>Màu sắc:</span>
                                    <div class="color-variant select-box-wrapper">
                                        <select class="select-box product-color">
                                            <option value="1">Xám nhạt</option>
                                            <option value="3">Đen</option>
                                            <option value="5">Trắng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sizes u-s-m-b-11">
                                    <span>Kích cỡ:</span>
                                    <div class="size-variant select-box-wrapper">
                                        <select class="select-box product-size">
                                            <option value="">Nam 2XL</option>
                                            <option value="">Nam 3XL</option>
                                            <option value="">Trẻ em 4</option>
                                            <option value="">Trẻ em 6</option>
                                            <option value="">Trẻ em 8</option>
                                            <option value="">Trẻ em 10</option>
                                            <option value="">Trẻ em 12</option>
                                            <option value="">Nữ Small</option>
                                            <option value="">Nam Small</option>
                                            <option value="">Nữ Medium</option>
                                            <option value="">Nam Medium</option>
                                            <option value="">Nữ Large</option>
                                            <option value="">Nam Large</option>
                                            <option value="">Nữ XL</option>
                                            <option value="">Nam XL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                <form action="#" class="post-form">
                                    <div class="quick-social-media-wrapper u-s-m-b-22">
                                        <span>Chia sẻ:</span>
                                        <ul class="social-media-list">
                                            <li>
                                                <a href="#">
                                                <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <i class="fas fa-rss"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="quantity-wrapper u-s-m-b-22">
                                        <span>Số lượng:</span>
                                        <div class="quantity">
                                            <input type="text" class="quantity-text-field" value="1">
                                            <a class="plus-a" data-max="1000">&#43;</a>
                                            <a class="minus-a" data-min="1">&#45;</a>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="button button-outline-secondary" type="submit">Thêm vào giỏ hàng</button>
                                        <button class="button button-outline-secondary far fa-heart u-s-m-l-6" title="Yêu thích"></button>
                                        <button class="button button-outline-secondary far fa-envelope u-s-m-l-6" title="Gửi email"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Product-details /- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view-Modal /- -->