@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Thương hiệu</h4>
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
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>

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

                            <form class="forms-sample"
                                  action="{{ empty($brand['id']) ? url('admin/add-edit-brand') : url('admin/add-edit-brand/' . $brand['id']) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="brand_name">Tên thương hiệu</label>
                                    <input type="text" class="form-control" id="brand_name"
                                           placeholder="Nhập tên thương hiệu"
                                           name="brand_name"
                                           value="{{ !empty($brand['name']) ? $brand['name'] : old('brand_name') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">
                                    {{ empty($brand['id']) ? 'Thêm thương hiệu' : 'Cập nhật' }}
                                </button>
                                <button type="reset" class="btn btn-secondary">Nhập lại</button>
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