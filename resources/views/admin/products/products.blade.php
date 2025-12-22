@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sản phẩm</h4>

                            <a href="{{ url('admin/add-edit-product') }}"
                               style="max-width: 150px; float: right; display: inline-block"
                               class="btn btn-block btn-primary">
                                Thêm sản phẩm
                            </a>

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="products" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Màu sắc</th>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Phân khu</th>
                                            <th>Người thêm</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product['id'] }}</td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td>{{ $product['product_color'] }}</td>
                                                <td>
                                                    @if (!empty($product['product_image']))
                                                        <img style="width:120px; height:100px"
                                                             src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}">
                                                    @else
                                                        <img style="width:120px; height:100px"
                                                             src="{{ asset('front/images/product_images/small/no-image.png') }}">
                                                    @endif
                                                </td>
                                                <td>{{ $product['category']['category_name'] }}</td>
                                                <td>{{ $product['section']['name'] }}</td>
                                                <td>
                                                    @if ($product['admin_type'] == 'vendor')
                                                        <a target="_blank"
                                                           href="{{ url('admin/view-vendor-details/' . $product['admin_id']) }}">
                                                            {{ ucfirst($product['admin_type']) }}
                                                        </a>
                                                    @else
                                                        {{ ucfirst($product['admin_type']) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product['status'] == 1)
                                                        <a class="updateProductStatus"
                                                           id="product-{{ $product['id'] }}"
                                                           product_id="{{ $product['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-check"
                                                               status="Active"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateProductStatus"
                                                           id="product-{{ $product['id'] }}"
                                                           product_id="{{ $product['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-outline"
                                                               status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Sửa sản phẩm"
                                                       href="{{ url('admin/add-edit-product/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-pencil-box"></i>
                                                    </a>
                                                    <a title="Thêm thuộc tính"
                                                       href="{{ url('admin/add-edit-attributes/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-plus-box"></i>
                                                    </a>
                                                    <a title="Thêm nhiều ảnh"
                                                       href="{{ url('admin/add-images/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-library-plus"></i>
                                                    </a>
                                                    <a href="JavaScript:void(0)"
                                                       class="confirmDelete"
                                                       module="product"
                                                       moduleid="{{ $product['id'] }}">
                                                        <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Bản quyền © 2022. Đã đăng ký bản quyền.
                </span>
            </div>
        </footer>
    </div>
@endsection
