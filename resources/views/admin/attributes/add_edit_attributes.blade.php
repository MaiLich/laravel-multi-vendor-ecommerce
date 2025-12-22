{{-- Trang này được render bởi phương thức addAttributes() trong Admin/ProductsController.php --}}
@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Thuộc tính sản phẩm</h4>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Hôm nay ({{ now()->format('d/m/Y') }})
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">Tháng 1 - Tháng 3</a>
                                        <a class="dropdown-item" href="#">Tháng 4 - Tháng 6</a>
                                        <a class="dropdown-item" href="#">Tháng 7 - Tháng 9</a>
                                        <a class="dropdown-item" href="#">Tháng 10 - Tháng 12</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm thuộc tính sản phẩm</h4>

                            {{-- Thông báo lỗi --}}
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Lỗi validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Thông báo thành công --}}
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="forms-sample" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên sản phẩm:</label>
                                            <strong>{{ $product['product_name'] }}</strong>
                                        </div>
                                        <div class="form-group">
                                            <label>Mã sản phẩm:</label>
                                            <strong>{{ $product['product_code'] }}</strong>
                                        </div>
                                        <div class="form-group">
                                            <label>Màu sắc:</label>
                                            <strong>{{ $product['product_color'] }}</strong>
                                        </div>
                                        <div class="form-group">
                                            <label>Giá gốc:</label>
                                            <strong>{{ number_format($product['product_price']) }} ₫</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <div class="form-group">
                                            <label>Hình ảnh sản phẩm:</label><br>
                                            @if (!empty($product['product_image']))
                                                <img style="width: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" 
                                                     src="{{ url('front/images/product_images/small/' . $product['product_image']) }}" 
                                                     alt="{{ $product['product_name'] }}">
                                            @else
                                                <img style="width: 200px; border-radius: 8px;" 
                                                     src="{{ url('front/images/product_images/small/no-image.png') }}" 
                                                     alt="Không có hình ảnh">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h5>Thêm biến thể mới (Kích thước, SKU, Giá, Tồn kho)</h5>
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text" name="size[]" placeholder="Kích thước (ví dụ: M, XL)" style="width: 140px;" class="form-control mr-2" required>
                                            <input type="text" name="sku[]" placeholder="Mã SKU" style="width: 140px;" class="form-control mr-2" required>
                                            <input type="number" name="price[]" placeholder="Giá bán" style="width: 140px;" class="form-control mr-2" required>
                                            <input type="number" name="stock[]" placeholder="Tồn kho" style="width: 140px;" class="form-control mr-2" required>
                                            <a href="javascript:void(0);" class="add_button btn btn-success btn-sm" title="Thêm biến thể">
                                                <i class="mdi mdi-plus"></i> Thêm
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Thêm thuộc tính</button>
                                <button type="reset" class="btn btn-secondary">Nhập lại</button>
                            </form>

                            <br><br><hr><br>

                            <h4 class="card-title">Danh sách thuộc tính hiện tại</h4>

                            <form method="post" action="{{ url('admin/edit-attributes/' . $product['id']) }}">
                                @csrf

                                <div class="table-responsive">
                                    <table id="products" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Kích thước</th>
                                                <th>Mã SKU</th>
                                                <th>Giá bán (₫)</th>
                                                <th>Tồn kho</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product['attributes'] as $attribute)
                                                <input type="hidden" name="attributeId[]" value="{{ $attribute['id'] }}">
                                                <tr>
                                                    <td>{{ $attribute['id'] }}</td>
                                                    <td><strong>{{ $attribute['size'] }}</strong></td>
                                                    <td>{{ $attribute['sku'] }}</td>
                                                    <td>
                                                        <input type="number" name="price[]" value="{{ $attribute['price'] }}" 
                                                               class="form-control form-control-sm" style="width: 100px;" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" 
                                                               class="form-control form-control-sm" style="width: 100px;" required min="0">
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($attribute['status'] == 1)
                                                            <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" 
                                                               attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)" 
                                                               title="Đang hoạt động">
                                                                <i style="font-size: 25px; color: #28a745;" class="mdi mdi-bookmark-check"></i>
                                                            </a>
                                                        @else
                                                            <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" 
                                                               attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)" 
                                                               title="Đã ẩn">
                                                                <i style="font-size: 25px; color: #dc3545;" class="mdi mdi-bookmark-outline"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if($product['attributes']->count() > 0)
                                    <button type="submit" class="btn btn-primary mt-3">Cập nhật thuộc tính</button>
                                @else
                                    <p class="text-muted mt-3">Chưa có thuộc tính nào cho sản phẩm này.</p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
    </div>
@endsection