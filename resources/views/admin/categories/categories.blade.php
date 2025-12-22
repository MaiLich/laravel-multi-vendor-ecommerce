@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Quản lý danh mục sản phẩm</h4>

                            <a href="{{ url('admin/add-edit-category') }}" class="btn btn-primary float-right">
                                <i class="mdi mdi-plus"></i> Thêm danh mục
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
                                <table id="categories" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên danh mục</th>
                                            <th>Danh mục cha</th>
                                            <th>Nhóm danh mục</th>
                                            <th>URL</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            @php
                                                $parent_category = isset($category['parent_category']['category_name']) && !empty($category['parent_category']['category_name'])
                                                    ? $category['parent_category']['category_name']
                                                    : 'Gốc (Root)';
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $category['id'] }}</td>
                                                <td>{{ $category['category_name'] }}</td>
                                                <td>{{ $parent_category }}</td>
                                                <td>{{ $category['section']['name'] }}</td>
                                                <td>{{ $category['url'] }}</td>
                                                <td class="text-center">
                                                    @if ($category['status'] == 1)
                                                        <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)" title="Đang hoạt động">
                                                            <i style="font-size: 25px; color: #28a745;" class="mdi mdi-bookmark-check"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)" title="Đã ẩn">
                                                            <i style="font-size: 25px; color: #dc3545;" class="mdi mdi-bookmark-outline"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('admin/add-edit-category/' . $category['id']) }}" title="Chỉnh sửa">
                                                        <i style="font-size: 25px; color: #007bff;" class="mdi mdi-pencil-box"></i>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid="{{ $category['id'] }}" title="Xóa danh mục">
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