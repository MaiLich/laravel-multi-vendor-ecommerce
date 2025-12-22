{{-- This page is rendered by orders() method inside Front/OrderController.php --}}
@extends('front.layout.layout')

@section('content')

<style>
    body {
        background-color: #f8f9fa;
        color: #222;
    }

    .page-intro h2 {
        color: #333;
        font-weight: 600;
    }

    /* ---------- Bảng hiển thị ---------- */
    .table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    }
    .table th, .table td {
        vertical-align: middle !important;
        border-color: #ddd !important;
    }
    .table thead th {
        background-color: #333;
        color: #fff;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
        transition: background 0.2s ease;
    }

    /* ---------- Thanh tìm kiếm kiểu Google ---------- */
    .search-wrapper {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 20px 25px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background: #f9fafb;
        border: 1px solid #ddd;
        border-radius: 25px;
        padding: 8px 15px;
        transition: all 0.2s ease-in-out;
    }
    .search-bar:hover {
        background: #fff;
        box-shadow: 0 0 6px rgba(0,0,0,0.08);
    }
    .search-bar i {
        color: #777;
        font-size: 18px;
        margin-right: 10px;
    }
    .search-bar input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 15px;
        color: #333;
    }

    .filter-toggle {
        display: inline-flex;
        align-items: center;
        color: #1a73e8;
        font-weight: 500;
        font-size: 15px;
        cursor: pointer;
        margin-top: 5px;
        user-select: none;
        transition: 0.2s;
    }
    .filter-toggle i {
        font-size: 17px;
        margin-right: 5px;
    }
    .filter-toggle:hover {
        text-decoration: underline;
        color: #0b57d0;
    }

    .filter-section {
        display: none;
        margin-top: 15px;
        background: #f8faff;
        border-radius: 8px;
        padding: 15px 20px;
        border: 1px solid #e1e4ea;
        animation: fadeIn 0.3s ease;
    }
    .filter-section.show {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        animation: slideDown 0.3s ease;
    }
    .filter-section label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }
    .filter-section input {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 14px;
        width: 180px;
    }
    .btn-clear {
        background-color: #1a73e8;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 7px 15px;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }
    .btn-clear:hover {
        background-color: #155cc0;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Tiêu đề -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Đơn hàng của tôi</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Trang chủ</a>
                </li>
                <li class="is-marked">
                    <a href="#">Đơn hàng</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Nội dung -->
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- 🔍 Thanh tìm kiếm -->
                <div class="search-wrapper">
                    <div class="search-bar">
                        <i class="fa fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Tìm kiếm mã đơn hoặc tên sản phẩm...">
                    </div>

                    <div class="filter-toggle" id="toggleFilter">
                        <i class="fa fa-filter"></i> Lọc theo ngày
                    </div>

                    <div class="filter-section" id="filterSection">
                        <div class="form-group">
                            <label>Từ ngày</label><br>
                            <input type="date" id="startDate">
                        </div>
                        <div class="form-group">
                            <label>Đến ngày</label><br>
                            <input type="date" id="endDate">
                        </div>
                        <div class="form-group d-flex align-items-end">
                            <button type="button" id="clearSearch" class="btn btn-clear">Xóa bộ lọc</button>
                        </div>
                    </div>
                </div>

                <!-- 🧾 Bảng đơn hàng -->
                <table class="table table-striped table-borderless" id="ordersTable">
                    <thead>
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Sản phẩm</th>
                            <th>Phương thức thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ url('user/orders/' . $order['id']) }}">{{ $order['id'] }}</a>
                                </td>
                                <td>
                                    @foreach ($order['orders_products'] as $product)
                                        <strong>{{ $product['product_code'] }}</strong> - {{ $product['product_name'] }}<br>
                                    @endforeach
                                </td>
                                <td>{{ $order['payment_method'] }}</td>
                                <td>{{ number_format($order['grand_total'], 0, ',', '.') }}₫</td>
                                <td>{{ date('d/m/Y', strtotime($order['created_at'])) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- 🧠 JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    const clearBtn = document.getElementById('clearSearch');
    const rows = document.querySelectorAll('#ordersTable tbody tr');
    const toggle = document.getElementById('toggleFilter');
    const filterSection = document.getElementById('filterSection');

    // 🔽 Hiện / Ẩn phần lọc ngày (slide-down)
    toggle.addEventListener('click', () => {
        filterSection.classList.toggle('show');
    });

    // 🔎 Lọc bảng theo từ khóa & ngày
    function filterTable() {
        const keyword = searchInput.value.toLowerCase().trim();
        const start = startDate.value ? new Date(startDate.value) : null;
        const end = endDate.value ? new Date(endDate.value) : null;

        rows.forEach(row => {
            const orderId = row.cells[0].innerText.toLowerCase();
            const products = row.cells[1].innerText.toLowerCase();
            const dateText = row.cells[4].innerText.trim();
            // Chuyển định dạng ngày từ d/m/Y sang Date object
            const [day, month, year] = dateText.split('/');
            const date = new Date(`${year}-${month}-${day}`);

            let matchKeyword = orderId.includes(keyword) || products.includes(keyword);
            let matchDate = true;

            if (start && date < start) matchDate = false;
            if (end && date > end) matchDate = false;

            row.style.display = (matchKeyword && matchDate) ? '' : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterTable);
    startDate.addEventListener('change', filterTable);
    endDate.addEventListener('change', filterTable);

    // ❌ Xóa bộ lọc
    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        startDate.value = '';
        endDate.value = '';
        rows.forEach(row => row.style.display = '');
        filterTable(); // Cập nhật lại bảng sau khi xóa
    });
});
</script>

@endsection