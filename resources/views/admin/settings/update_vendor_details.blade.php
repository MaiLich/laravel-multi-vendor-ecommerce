@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Cập nhật thông tin nhà cung cấp</h3>

                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Hôm nay (10 Tháng 1 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">Tháng 1 - Tháng 3</a>
                                        <a class="dropdown-item" href="#">Tháng 3 - Tháng 6</a>
                                        <a class="dropdown-item" href="#">Tháng 6 - Tháng 8</a>
                                        <a class="dropdown-item" href="#">Tháng 8 - Tháng 11</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
            @if ($slug == 'personal') {{-- $slug was passed from AdminController to view (using compact() method) --}}
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cập nhật thông tin cá nhân</h4>


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

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

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
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="form-group">
                                        <label>Tên đăng nhập / Email nhà cung cấp</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Họ tên</label>
                                        <input type="text" class="form-control" id="vendor_name" placeholder="Nhập họ tên" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_address">Địa chỉ</label>
                                        <input type="text" class="form-control" id="vendor_address" placeholder="Nhập địa chỉ" name="vendor_address" value="{{ $vendorDetails['address'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_city">Thành phố</label>
                                        <input type="text" class="form-control" id="vendor_city" placeholder="Nhập thành phố" name="vendor_city" value="{{ $vendorDetails['city'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_state">Tỉnh / Bang</label>
                                        <input type="text" class="form-control" id="vendor_state" placeholder="Nhập tỉnh / bang" name="vendor_state" value="{{ $vendorDetails['state'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_country">Quốc gia</label>
                                    
                                        <select class="form-control" id="vendor_country" name="vendor_country"  style="color: #495057">
                                            <option value="">Chọn quốc gia</option>

                                            @foreach ($countries as $country)
                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == $vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_pincode">Mã bưu chính</label>
                                        <input type="text" class="form-control" id="vendor_pincode" placeholder="Nhập mã bưu chính" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_mobile">Số điện thoại</label>
                                        <input type="text" class="form-control" id="vendor_mobile" placeholder="Nhập số điện thoại 10 chữ số" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="10" minlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_image">Ảnh nhà cung cấp</label>
                                        <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                        @if (!empty(Auth::guard('admin')->user()->image))
                                            <a target="_blank" href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">Xem ảnh</a>
                                            <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                    <button type="reset"  class="btn btn-light">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($slug == 'business') 
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cập nhật thông tin kinh doanh</h4>


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

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

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
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="form-group">
                                        <label>Tên đăng nhập / Email nhà cung cấp</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_name">Tên cửa hàng</label>
                                        <input type="text" class="form-control" id="shop_name" placeholder="Nhập tên cửa hàng" name="shop_name"  @if (isset($vendorDetails['shop_name'])) value="{{ $vendorDetails['shop_name'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_address">Địa chỉ cửa hàng</label>
                                        <input type="text" class="form-control" id="shop_address" placeholder="Nhập địa chỉ cửa hàng" name="shop_address"  @if (isset($vendorDetails['shop_address'])) value="{{ $vendorDetails['shop_address'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_city">Thành phố</label>
                                        <input type="text" class="form-control" id="shop_city" placeholder="Nhập thành phố" name="shop_city"  @if (isset($vendorDetails['shop_city'])) value="{{ $vendorDetails['shop_city'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_state">Tỉnh / Bang</label>
                                        <input type="text" class="form-control" id="shop_state" placeholder="Nhập tỉnh / bang" name="shop_state"  @if (isset($vendorDetails['shop_state'])) value="{{ $vendorDetails['shop_state'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_country">Quốc gia</label>
                                    
                                        <select class="form-control" id="shop_country" name="shop_country" style="color: #495057">
                                            <option value="">Chọn quốc gia</option>

                                            @foreach ($countries as $country)
                                                <option value="{{ $country['country_name'] }}"  @if (isset($vendorDetails['shop_country']) && $country['country_name'] == $vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_pincode">Mã bưu chính</label>
                                        <input type="text" class="form-control" id="shop_pincode" placeholder="Nhập mã bưu chính" name="shop_pincode"  @if (isset($vendorDetails['shop_pincode'])) value="{{ $vendorDetails['shop_pincode'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_mobile">Số điện thoại cửa hàng</label>
                                        <input type="text" class="form-control" id="shop_mobile" placeholder="Nhập số điện thoại cửa hàng 10 chữ số" name="shop_mobile"  @if (isset($vendorDetails['shop_mobile'])) value="{{ $vendorDetails['shop_mobile'] }}" @endif maxlength="10" minlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_mobile">Website cửa hàng</label>
                                        <input type="text" class="form-control" id="shop_website" placeholder="Nhập website cửa hàng" name="shop_website"  @if (isset($vendorDetails['shop_website'])) value="{{ $vendorDetails['shop_website'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_license_number">Số giấy phép kinh doanh</label>
                                        <input type="text" class="form-control" id="business_license_number" placeholder="Nhập số giấy phép kinh doanh" name="business_license_number"  @if (isset($vendorDetails['business_license_number'])) value="{{ $vendorDetails['business_license_number'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="gst_number">Mã số thuế GST</label>
                                        <input type="text" class="form-control" id="gst_number" placeholder="Nhập mã số thuế GST" name="gst_number"  @if (isset($vendorDetails['gst_number'])) value="{{ $vendorDetails['gst_number'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="pan_number">Số PAN</label>
                                        <input type="text" class="form-control" id="pan_number" placeholder="Nhập số PAN" name="pan_number"  @if (isset($vendorDetails['pan_number'])) value="{{ $vendorDetails['pan_number'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_proof">Giấy tờ xác minh địa chỉ</label>
                                        <select class="form-control" name="address_proof" id="address_proof">
                                            <option value="Passport"        @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Passport')        selected @endif>Hộ chiếu</option>
                                            <option value="Voting Card"     @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Voting Card')     selected @endif>Thẻ cử tri</option>
                                            <option value="PAN"             @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'PAN')             selected @endif>PAN</option>
                                            <option value="Driving License" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Driving License') selected @endif>Giấy phép lái xe</option>
                                            <option value="Aadhar card"     @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Aadhar card')     selected @endif>Thẻ Aadhar</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_proof_image">Ảnh giấy tờ xác minh</label>
                                        <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                        @if (!empty($vendorDetails['address_proof_image']))
                                            <a target="_blank" href="{{ url('admin/images/proofs/' . $vendorDetails['address_proof_image']) }}">Xem ảnh</a>
                                            <input type="hidden" name="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                    <button type="reset"  class="btn btn-light">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($slug == 'bank')
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cập nhật thông tin ngân hàng</h4>


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

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

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
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data"> @csrf
                                    <div class="form-group">
                                        <label>Tên đăng nhập / Email nhà cung cấp</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_holder_name">Tên chủ tài khoản</label>
                                        <input type="text" class="form-control" id="account_holder_name" placeholder="Nhập tên chủ tài khoản" name="account_holder_name"  @if (isset($vendorDetails['account_holder_name'])) value="{{ $vendorDetails['account_holder_name'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Tên ngân hàng</label>
                                        <input type="text" class="form-control" id="bank_name" placeholder="Nhập tên ngân hàng" name="bank_name"  @if (isset($vendorDetails['bank_name'])) value="{{ $vendorDetails['bank_name'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Số tài khoản</label>
                                        <input type="text" class="form-control" id="account_number" placeholder="Nhập số tài khoản" name="account_number"  @if (isset($vendorDetails['account_number'])) value="{{ $vendorDetails['account_number'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_ifsc_code">Mã IFSC ngân hàng</label>
                                        <input type="text" class="form-control" id="bank_ifsc_code" placeholder="Nhập mã IFSC ngân hàng" name="bank_ifsc_code"  @if (isset($vendorDetails['bank_ifsc_code'])) value="{{ $vendorDetails['bank_ifsc_code'] }}" @endif>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                    <button type="reset"  class="btn btn-light">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
