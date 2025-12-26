{{-- Trang này được include bởi add_edit_product.php để hiển thị các bộ lọc liên quan <select> cho sản phẩm mới THÙY THEO DANH MỤC đã chọn --}}

@php

    $productFilters = \App\Models\ProductsFilter::productFilters(); // Lấy TẤT CẢ bộ lọc (đang bật/hoạt động)
    // dd($productFilters);

    // Lưu ý: $category_id có thể đến từ 2 nơi: AJAX call (truyền vào categoryFilters() trong Admin/FilterController.php)
    // HOẶC từ object $product khi 'Sửa sản phẩm' trong addEditProduct() của Admin/ProductsController

    // Trường hợp chỉ dành cho 'Sửa sản phẩm' (KHÔNG phải 'Thêm sản phẩm' và KHÔNG phải $category_id từ AJAX),
    // khi $product được truyền từ addEditProduct() trong Admin/ProductsController
    if (isset($product['category_id'])) {
        $category_id = $product['category_id'];
    }
@endphp


@foreach ($productFilters as $filter) {{-- hiển thị TẤT CẢ bộ lọc (đang bật/hoạt động) --}}
    @php
        // echo '<pre>', var_dump($product), '</pre>';
        // exit;
        // echo '<pre>', var_dump($filter), '</pre>';
        // exit;
        // dd($filter);
    @endphp

    @if (isset($category_id)) {{-- đến từ AJAX (categoryFilters() trong Admin/FilterController.php) và cũng có thể đến từ if phía trên khi 'Sửa sản phẩm' --}}
        @php
            // dd($filter);

            // Với mỗi filter trong bảng `products_filters`, lấy `cat_ids` của filter đó bằng filterAvailable(),
            // sau đó kiểm tra category hiện tại ($category_id) có nằm trong `cat_ids` không.
            // Nếu có thì hiển thị filter, nếu không thì không hiển thị.
            $filterAvailable = \App\Models\ProductsFilter::filterAvailable($filter['id'], $category_id); // $category_id đến từ AJAX (xem categoryFilters() trong Admin/FilterController.php)
        @endphp

        @if ($filterAvailable == 'Yes') {{-- nếu filter có category_id hiện tại trong `cat_ids` --}}
            <div class="form-group">
                <label for="{{ $filter['filter_column'] }}">Chọn {{ $filter['filter_name'] }}</label> {{-- Chỉ hiển thị các filter liên quan của sản phẩm (KHÔNG phải tất cả filter) --}}
                <select name="{{ $filter['filter_column'] }}" id="{{ $filter['filter_column'] }}" class="form-control text-dark"> {{-- $filter['filter_column'] ví dụ: 'ram' --}}
                    <option value="">Chọn giá trị bộ lọc</option>
                    @foreach ($filter['filter_values'] as $value) {{-- hiển thị các giá trị liên quan của filter --}}
                        @php
                            // echo '<pre>', var_dump($value), '</pre>'; exit;
                        @endphp
                        <option value="{{ $value['filter_value'] }}" @if (!empty($product[$filter['filter_column']]) && $product[$filter['filter_column']] == $value['filter_value']) selected @endif>{{ ucwords($value['filter_value']) }}</option> {{-- $value['filter_value'] ví dụ: '4GB' --}} {{-- $product[$filter['filter_column']] ví dụ: $product['screen_size'] có thể bằng '5 to 5.4 in' --}}
                    @endforeach
                </select>
            </div>
        @endif
    @endif
@endforeach
