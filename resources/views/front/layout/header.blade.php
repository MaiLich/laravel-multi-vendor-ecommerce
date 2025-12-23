<?php
// Getting the 'enabled' sections ONLY and their child categories (using the 'categories' relationship method) which, in turn, include their 'subcategories`
$sections = \App\Models\Section::sections();
// dd($sections);
?>



<!-- Header -->
<header>
    <!-- Top-Header -->
    <div class="full-layer-outer-header">
        <div class="container clearfix">
            <nav>
                <ul class="primary-nav g-nav">
                    <li>
                        <a href="tel:+201255845857">
                        <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                        Điện thoại: +8412345678</a>
                    </li>
                    <li>
                        <a href="mailto:info@multi-vendore-commerce.com">
                        <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                        Email: info@Doantotnghiep.com
                        </a>
                    </li>
                </ul>
            </nav>
            <nav>
                <ul class="secondary-nav g-nav">
                    <li>



                        <a>
                            {{-- If the user is authenticated/logged in, show 'My Account', if not, show 'Login/Register' --}} 
                            @if (\Illuminate\Support\Facades\Auth::check())
                                Tài khoản
                            @else
                                Đăng nhập / Đăng ký
                            @endif

                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                        </a>
                        <ul class="g-dropdown" style="width:200px">
                            <li>
                                <a href="{{ url('cart') }}">
                                <i class="fas fa-cog u-s-m-r-9"></i>
                                Giỏ hàng của tôi</a>
                            </li>
                            <li>
                                <a href="{{ url('checkout') }}">
                                <i class="far fa-check-circle u-s-m-r-9"></i>
                                Thanh toán</a>
                            </li>



                            {{-- If the user is authenticated/logged in, show 'My Account' and 'Logout', if not, show 'Customer Login' and 'Vendor Login' --}} 
                            @if (\Illuminate\Support\Facades\Auth::check())
                                <li>
                                    <a href="{{ url('user/account') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Tài khoản của tôi
                                    </a>
                                </li>

                                
                                <li>
                                    <a href="{{ url('user/orders') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Đơn hàng của tôi
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('user/logout') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Đăng xuất
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('user/login-register') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Đăng nhập (Khách hàng)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('vendor/login-register') }}">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Đăng nhập (Nhà bán)
                                    </a>
                                </li>
                            @endif



                        </ul>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </div>
    <!-- Top-Header /- -->
    <!-- Mid-Header -->
    <div class="full-layer-mid-header">
        <div class="container">
            <div class="row clearfix align-items-center">
                <div class="col-lg-3 col-md-9 col-sm-6">
                    <div class="brand-logo text-lg-center">


                        <a href="{{ url('/') }}">


                            <img src="{{ asset('front/images/main-logo/main-logo.png') }}" alt="Ứng dụng Thương mại Điện tử Đa nhà bán hàng" class="app-brand-logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 u-d-none-lg">



                    {{-- Website Search Form (to search for all website products) --}} 
                    <form class="form-searchbox" action="{{ url('/search-products') }}" method="get">
                        <label class="sr-only" for="search-landscape">Tìm kiếm</label>
                        <input id="search-landscape" type="text" class="text-field" placeholder="Tìm kiếm sản phẩm..." name="search" @if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) value="{{ $_REQUEST['search'] }}" @endif>
                        <div class="select-box-position">
                            <div class="select-box-wrapper select-hide">
                                <label class="sr-only" for="select-category">Chọn danh mục tìm kiếm</label>
                                <select class="select-box" id="select-category" name="section_id">

                                    <option selected="selected" value="">Tất cả</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section['id'] }}"  @if (isset($_REQUEST['section_id']) && !empty($_REQUEST['section_id']) && $_REQUEST['section_id'] == $section['id']) selected @endif>{{ $section['name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <button id="btn-search" type="submit" class="button button-primary fas fa-search"></button>
                    </form>

                    @php
                        // dd($_GET);
                    @endphp



                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <nav>
                        <ul class="mid-nav g-nav">
                            <li class="u-d-none-lg">
                                <a href="{{ url('/') }}">
                                <i class="ion ion-md-home u-c-brand"></i>
                                </a>
                            </li>
                            <li>
                                <a id="mini-cart-trigger">
                                <i class="ion ion-md-basket"></i>
                                <span class="item-counter totalCartItems">{{ totalCartItems() }}</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Mid-Header /- -->
    <!-- Responsive-Buttons -->
    <div class="fixed-responsive-container">
        <div class="fixed-responsive-wrapper">
            <button type="button" class="button fas fa-search" id="responsive-search"></button>
        </div>
    </div>
    <!-- Responsive-Buttons /- -->



    <!-- Mini Cart Widget -->
    <div id="appendHeaderCartItems">
        @include('front.layout.header_cart_items')
    </div>
    <!-- Mini Cart Widget /- -->



    <!-- Bottom-Header -->
    <div class="full-layer-bottom-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="v-menu v-close">
                        <span class="v-title">
                        <i class="ion ion-md-menu"></i>
                        Tất cả danh mục
                        <i class="fas fa-angle-down"></i>
                        </span>
                        <nav>
                            <div class="v-wrapper">
                                <ul class="v-list animated fadeIn">



                                    @foreach ($sections as $section)
                                        @if (count($section['categories']) > 0)
                                            <li class="js-backdrop">
                                                <a href="javascript:;">
                                                <i class="ion-ios-add-circle"></i>


                                                {{ $section['name'] }}


                                                <i class="ion ion-ios-arrow-forward"></i>
                                                </a>
                                                <button class="v-button ion ion-md-add"></button>
                                                <div class="v-drop-right" style="width: 700px;">
                                                    <div class="row">



                                                        @foreach ($section['categories'] as $category)
                                                            <div class="col-lg-4">
                                                                <ul class="v-level-2">
                                                                    <li>
                                                                        <a href="{{ url($category['url']) }}">{{ $category['category_name'] }}</a>
                                                                        <ul>


 
                                                                            @foreach ($category['sub_categories'] as $subcategory)
                                                                            <li>
                                                                                <a href="{{ url($subcategory['url']) }}">{{ $subcategory['category_name'] }}</a>
                                                                            </li>
                                                                            @endforeach



                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach


                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-9">
                    <ul class="bottom-nav g-nav u-d-none-lg">
                        <li>
                            <a href="{{ url('search-products?search=new-arrivals') }}">Sản phẩm mới 
                            <span class="superscript-label-new">MỚI</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('search-products?search=best-sellers') }}">Bán chạy 
                            <span class="superscript-label-hot">HOT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('search-products?search=featured') }}">Nổi bật 
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('search-products?search=discounted') }}">Giảm giá 
                            <span class="superscript-label-discount">>10%</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.blog.index') }}">Blog</a>
                        </li>
                        <li>
                            <a href="{{ route('chatbot.index') }}">ChatBot</a>
                        </li>
                        <li class="mega-position">
                            <a>Thêm
                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <div class="mega-menu mega-3-colm">
                                <ul>
                                    <li class="menu-title">CÔNG TY</li>
                                    <li>
                                        <a href="{{ url('about-us') }}" class="u-c-brand">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('contact') }}">Liên hệ</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('faq') }}">Câu hỏi thường gặp</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="menu-title">DANH MỤC</li>
                                    <li>
                                        <a href="{{ url('men') }}">Thời trang Nam</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('women') }}">Thời trang Nữ</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('kids') }}">Thời trang Trẻ em</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="menu-title">TÀI KHOẢN</li>
                                    <li>
                                        <a href="{{ url('user/account') }}">Tài khoản của tôi</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/orders') }}">Đơn hàng của tôi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom-Header /- -->
</header>
<!-- Header /- -->