{{-- Note: listing.blade.php is the page (rendered by listing() method in Front/ProductsController.php) that opens when you click on a category in the FRONT home page --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Danh mục sản phẩm</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:;">Danh mục sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->

    <!-- Shop-Page -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>


                    {{-- Breadcrumbs --}} 
                    @php echo $categoryDetails['breadcrumbs']; @endphp



                </ul>
            </div>
            <!-- Shop-Intro /- -->
            <div class="row">



                {{-- Include the listing page sidebar (Products filters (size, color, ...)) --}}
                @include('front.products.filters')



                <!-- Shop-Right-Wrapper -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <!-- Page-Bar -->
                    <div class="page-bar clearfix">



                        {{-- If the Search Form is not used for searching in front/layout/header.blade.php. Note that Filters will be hidden and won't work in case of using the Search Form --}} 
                        @if (!isset($_REQUEST['search']))


                            <!-- Toolbar Sorter 1  -->
                            <form name="sortProducts" id="sortProducts">
                                
                                <input type="hidden" name="url" id="url" value="{{ $url }}">

                                <div class="toolbar-sorter">
                                    <div class="select-box-wrapper">
                                        <label class="sr-only" for="sort-by">Sắp xếp theo</label>
                                        <select name="sort" id="sort" class="select-box">
                                            <option value="" selected>Chọn sắp xếp</option>
                                            <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_latest') selected @endif>Mới nhất</option>
                                            <option value="price_lowest"   @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowest')   selected @endif>Giá: Thấp → Cao</option>
                                            <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest')  selected @endif>Giá: Cao → Thấp</option>
                                            <option value="name_a_z"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_a_z')       selected @endif>Tên: A → Z</option>
                                            <option value="name_z_a"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_z_a')       selected @endif>Tên: Z → A</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <!-- //end Toolbar Sorter 1  -->


                        @endif



                        <!-- Toolbar Sorter 2  -->
                        <div class="toolbar-sorter-2">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="show-records">Hiển thị số bản ghi mỗi trang</label>
                                <select class="select-box" id="show-records">
                                    <option selected="selected" value="">Hiển thị: {{ count($categoryProducts) }}</option>
                                    <option value="">Hiển thị: Tất cả</option>
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 2  -->
                    </div>
                    <!-- Page-Bar /- -->


                    <!-- Row-of-Product-Container -->

                    <div class="filter_products">
                        @include('front.products.ajax_products_listing')
                    </div>

                    <!-- Row-of-Product-Container /- -->



                    @if (!isset($_REQUEST['search']))


                        @if (isset($_GET['sort']))
                            <div>
                                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                            </div>
                        @else
                            <div>
                                {{ $categoryProducts->links() }}
                            </div>
                        @endif


                    @endif


                    <div>&nbsp;</div>

                    {{-- Show the category and subcategory description --}} 
                    <div>{!! $categoryDetails['categoryDetails']['description'] !!}</div>



                </div>
                <!-- Shop-Right-Wrapper /- -->


            </div>
        </div>
    </div>
    <!-- Shop-Page /- -->
@endsection