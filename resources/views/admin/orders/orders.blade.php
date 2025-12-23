{{-- This page is rendered by orders() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách đơn hàng</h4>

                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="orders" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email khách hàng</th>
                                            <th>Sản phẩm đã đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái đơn</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // dd($orders); // check if the authenticated/logged-in user is 'vendor' (show ONLY orders of products belonging to them), or 'admin' (show ALL orders)
                                        @endphp
                                        @foreach ($orders as $order)
                                            @if ($order['orders_products']) {{-- If the 'vendor' has ordered products (if a 'vendor' product has been ordered), show them. --}}
                                                <tr>
                                                    <td>{{ $order['id'] }}</td>
                                                    <td>{{ date('Y-m-d h:i:s', strtotime($order['created_at'])) }}</td>
                                                    <td>{{ $order['name'] }}</td>
                                                    <td>{{ $order['email'] }}</td>
                                                    <td>
                                                        @foreach ($order['orders_products'] as $product)
                                                            {{ $product['product_code'] }} ({{ $product['product_qty'] }})
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $order['grand_total'] }}</td>
                                                    <td>{{ $order['order_status'] }}</td>
                                                    <td>{{ $order['payment_method'] }}</td>
                                                    <td>
                                                        <a title="Xem chi tiết đơn hàng" href="{{ url('admin/orders/' . $order['id']) }}">
                                                            <i style="font-size: 25px" class="mdi mdi-file-document"></i>
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        {{-- View HTML invoice --}}
                                                        <a title="Xem hóa đơn" href="{{ url('admin/orders/invoice/' . $order['id']) }}" target="_blank">
                                                            <i style="font-size: 25px" class="mdi mdi-printer"></i>
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        {{-- View PDF invoice --}}
                                                        <a title="In hóa đơn PDF" href="{{ url('admin/orders/invoice/pdf/' . $order['id']) }}" target="_blank">
                                                            <i style="font-size: 25px" class="mdi mdi-file-pdf"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Bản quyền © 2022. Đã đăng ký bản quyền.
                </span>
            </div>
        </footer>
    </div>
@endsection
