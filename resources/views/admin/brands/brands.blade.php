@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Quản lý thương hiệu</h4>

                            <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-primary float-right">
                                <i class="mdi mdi-plus"></i> Thêm thương hiệu
                            </a>

                            {{-- Thông báo thành công --}}
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    <strong>Thành công:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive pt-3">
                                <table id="brands" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên thương hiệu</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td class="text-center">{{ $brand['id'] }}</td>
                                                <td>{{ $brand['name'] }}</td>
                                                <td class="text-center">
                                                    @if ($brand['status'] == 1)
                                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)" title="Đang hoạt động">
                                                            <i style="font-size: 25px; color: #28a745;" class="mdi mdi-bookmark-check"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)" title="Đã ẩn">
                                                            <i style="font-size: 25px; color: #dc3545;" class="mdi mdi-bookmark-outline"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('admin/add-edit-brand/' . $brand['id']) }}" title="Chỉnh sửa">
                                                        <i style="font-size: 25px; color: #007bff;" class="mdi mdi-pencil-box"></i>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0)" class="confirmDelete" module="brand" moduleid="{{ $brand['id'] }}" title="Xóa thương hiệu">
                                                        <i style="font-size: 25px; color: #dc3545;" class="mdi mdi-delete"></i>
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

        <!-- content-wrapper ends -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Bản quyền © {{ date('Y') }}. Đã đăng ký bản quyền.</span>
            </div>
        </footer>
    </div>
@endsection