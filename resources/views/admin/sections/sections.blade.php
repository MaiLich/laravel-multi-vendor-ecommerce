@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh mục cha</h4>

                            <a href="{{ url('admin/add-edit-section') }}"
                               style="max-width: 150px; float: right; display: inline-block"
                               class="btn btn-block btn-primary">
                                Thêm Danh mục cha
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
                                <table id="sections" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên Danh mục cha</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sections as $section)
                                            <tr>
                                                <td>{{ $section['id'] }}</td>
                                                <td>{{ $section['name'] }}</td>
                                                <td>
                                                    @if ($section['status'] == 1)
                                                        <a class="updateSectionStatus"
                                                           id="section-{{ $section['id'] }}"
                                                           section_id="{{ $section['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-check"
                                                               status="Active"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateSectionStatus"
                                                           id="section-{{ $section['id'] }}"
                                                           section_id="{{ $section['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-outline"
                                                               status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Sửa Danh mục cha"
                                                       href="{{ url('admin/add-edit-section/' . $section['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-pencil-box"></i>
                                                    </a>

                                                    <a href="JavaScript:void(0)"
                                                       class="confirmDelete"
                                                       module="section"
                                                       moduleid="{{ $section['id'] }}">
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
