@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Cài đặt quản trị</h3>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle"
                                            type="button" id="dropdownMenuDate2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Hôm nay (10 Jan 2021)
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

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Lỗi:</strong> {{ Session::get('error_message') }}
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

                            <h4 class="card-title">Cập nhật mật khẩu quản trị</h4>

                            <form class="forms-sample"
                                  action="{{ url('admin/update-admin-password') }}"
                                  method="post">
                                @csrf

                                <div class="form-group">
                                    <label>Tài khoản / Email quản trị</label>
                                    <input class="form-control"
                                           value="{{ $adminDetails['email'] }}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label>Loại tài khoản</label>
                                    <input class="form-control"
                                           value="{{ $adminDetails['type'] }}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="current_password">Mật khẩu hiện tại</label>
                                    <input type="password"
                                           class="form-control"
                                           id="current_password"
                                           placeholder="Nhập mật khẩu hiện tại"
                                           name="current_password"
                                           required>
                                    <span id="check_password"></span>
                                </div>

                                <div class="form-group">
                                    <label for="new_password">Mật khẩu mới</label>
                                    <input type="password"
                                           class="form-control"
                                           id="new_password"
                                           placeholder="Nhập mật khẩu mới"
                                           name="new_password"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Xác nhận mật khẩu</label>
                                    <input type="password"
                                           class="form-control"
                                           id="confirm_password"
                                           placeholder="Nhập lại mật khẩu"
                                           name="confirm_password"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                <button type="reset" class="btn btn-light">Hủy</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layout.footer')
    </div>
@endsection
