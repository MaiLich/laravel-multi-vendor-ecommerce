@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Chi tiết nhà bán hàng</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/admins/vendor') }}">Quay lại danh sách nhà bán hàng</a></h6>
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
                <!-- Thông tin cá nhân -->
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thông tin cá nhân</h4>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{ $vendorDetails['vendor_personal']['email'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['name'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Thành phố</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['city'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tỉnh/ Bang</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['state'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Quốc gia</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['country'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã bưu điện</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['pincode'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['mobile'] }}" readonly>
                            </div>
                            @if (!empty($vendorDetails['image']))
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <br>
                                    <img style="width: 200px; border-radius: 8px;" src="{{ url('admin/images/photos/' . $vendorDetails['image']) }}" alt="Ảnh đại diện">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Thông tin cửa hàng -->
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thông tin cửa hàng</h4>
                            <div class="form-group">
                                <label>Tên cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_name'])) value="{{ $vendorDetails['vendor_business']['shop_name'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_address'])) value="{{ $vendorDetails['vendor_business']['shop_address'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Thành phố cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_city'])) value="{{ $vendorDetails['vendor_business']['shop_city'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Tỉnh/ Bang cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_state'])) value="{{ $vendorDetails['vendor_business']['shop_state'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Quốc gia cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_country'])) value="{{ $vendorDetails['vendor_business']['shop_country'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã bưu điện cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_pincode'])) value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_mobile'])) value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Website cửa hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_website'])) value="{{ $vendorDetails['vendor_business']['shop_website'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Email cửa hàng</label>
                                <input class="form-control" @if (isset($vendorDetails['vendor_business']['shop_email'])) value="{{ $vendorDetails['vendor_business']['shop_email'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Số đăng ký kinh doanh</label>
                                <input class="form-control" @if (isset($vendorDetails['vendor_business']['business_license_number'])) value="{{ $vendorDetails['vendor_business']['business_license_number'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã số thuế (GST)</label>
                                <input class="form-control" @if (isset($vendorDetails['vendor_business']['gst_number'])) value="{{ $vendorDetails['vendor_business']['gst_number'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã số thuế cá nhân (PAN)</label>
                                <input class="form-control" @if (isset($vendorDetails['vendor_business']['pan_number'])) value="{{ $vendorDetails['vendor_business']['pan_number'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Loại giấy tờ chứng minh địa chỉ</label>
                                <input class="form-control" @if (isset($vendorDetails['vendor_business']['address_proof'])) value="{{ $vendorDetails['vendor_business']['address_proof'] }}" @endif readonly>
                            </div>
                            @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                <div class="form-group">
                                    <label>Hình ảnh chứng minh địa chỉ</label>
                                    <br>
                                    <img style="width: 200px; border-radius: 8px;" src="{{ url('admin/images/proofs/' . $vendorDetails['vendor_business']['address_proof_image']) }}" alt="Chứng minh địa chỉ">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Thông tin ngân hàng -->
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thông tin ngân hàng</h4>
                            <div class="form-group">
                                <label>Tên chủ tài khoản</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Tên ngân hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Số tài khoản</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã IFSC ngân hàng</label>
                                <input type="text" class="form-control" @if (isset($vendorDetails['vendor_bank']['bank_ifsc_code'])) value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" @endif readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin hoa hồng -->
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cài đặt hoa hồng</h4>

                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Lỗi:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

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

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Hoa hồng mỗi sản phẩm bán được (%)</label>
                                <form method="post" action="{{ url('admin/update-vendor-commission') }}">
                                    @csrf
                                    <input type="hidden" name="vendor_id" value="{{ $vendorDetails['vendor_personal']['id'] }}">
                                    <input class="form-control" type="number" step="0.01" name="commission"
                                           @if (isset($vendorDetails['vendor_personal']['commission'])) value="{{ $vendorDetails['vendor_personal']['commission'] }}" @endif
                                           required placeholder="Ví dụ: 10.5">
                                    <small class="text-muted">Phần trăm hoa hồng mà nhà bán hàng phải trả cho nền tảng trên mỗi đơn hàng.</small>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary">Cập nhật hoa hồng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
    </div>
@endsection