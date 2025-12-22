{{-- This view is rendered by ratings() method in Admin/RatingController.php --}}
@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Đánh giá</h4>

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
                                <table id="ratings" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Email người dùng</th>
                                            <th>Nội dung đánh giá</th>
                                            <th>Số sao</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ratings as $rating)
                                            <tr>
                                                <td>{{ $rating['id'] }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ url('product/' . $rating['product']['id']) }}">
                                                        {{ $rating['product']['product_name'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $rating['user']['email'] }}</td>
                                                <td>{{ $rating['review'] }}</td>
                                                <td>{{ $rating['rating'] }}</td>
                                                <td>
                                                    @if ($rating['status'] == 1)
                                                        <a class="updateRatingStatus"
                                                           id="rating-{{ $rating['id'] }}"
                                                           rating_id="{{ $rating['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-check"
                                                               status="Active"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateRatingStatus"
                                                           id="rating-{{ $rating['id'] }}"
                                                           rating_id="{{ $rating['id'] }}"
                                                           href="javascript:void(0)">
                                                            <i style="font-size: 25px"
                                                               class="mdi mdi-bookmark-outline"
                                                               status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="JavaScript:void(0)"
                                                       class="confirmDelete"
                                                       module="rating"
                                                       moduleid="{{ $rating['id'] }}">
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
