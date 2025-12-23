@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Chào mừng {{ Auth::guard('admin')->user()->name }}</h3> {{--
                            Accessing Specific Guard Instances:
                            https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                            <!-- https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user -->
                            <!-- https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances -->
                            <!-- https://laravel.com/docs/9.x/eloquent#retrieving-models -->
                            <h6 class="font-weight-normal mb-0">Tất cả hệ thống đang hoạt động ổn định!</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Hàng 1 -->
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-danger h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng loại</p>
                            <p class="fs-30 mb-0">{{ $sectionsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-dark-blue h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số danh mục</p>
                            <p class="fs-30 mb-0">{{ $categoriesCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-warning h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số người dùng</p>
                            <p class="fs-30 mb-0">{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-success h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số thương hiệu</p>
                            <p class="fs-30 mb-0">{{ $brandsCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hàng 2 -->
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-tale h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số đơn hàng</p>
                            <p class="fs-30 mb-0">{{ $ordersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-blue h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Đơn hàng giao thành công</p>
                            <p class="fs-30 mb-0">{{ $ordersByStatus['shipped'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-danger h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Đơn hàng đang xử lý</p>
                            <p class="fs-30 mb-0">{{ $ordersByStatus['processing'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-dark-blue h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Đơn hàng đã hủy</p>
                            <p class="fs-30 mb-0">{{ $ordersByStatus['canceled'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hàng 3 -->
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-warning h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số sản phẩm</p>
                            <p class="fs-30 mb-0">{{ $productsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card mb-4">
                    <div class="card card-light-success h-100">
                        <div class="card-body text-center">
                            <p class="mb-2">Tổng số mã giảm giá</p>
                            <p class="fs-30 mb-0">{{ $couponsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="row mt-5">
            <!-- Biểu đồ Doanh thu theo ngày -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Doanh thu theo ngày</h4>
                        <canvas id="dailyRevenueChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ Doanh thu theo tháng -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Doanh thu theo tháng</h4>
                        <canvas id="monthlyRevenueChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ Doanh thu theo năm -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Doanh thu theo năm</h4>
                        <canvas id="yearlyRevenueChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Sản phẩm được mua nhiều nhất -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Sản phẩm được mua nhiều nhất</h4>
                        <canvas id="mostPurchasedChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm bán chạy nhất -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Sản phẩm bán chạy nhất</h4>
                        <canvas id="bestSellingChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm tồn kho nhiều nhất -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-center">Sản phẩm còn tồn kho nhiều nhất</h4>
                        <canvas id="mostInStockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>




        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Đưa dữ liệu từ Controller sang JS -->
        <script>
            const revenueByDay = @json($revenueByDay);
            const revenueByMonth = @json($revenueByMonth);
            const revenueByYear = @json($revenueByYear);

            // === Biểu đồ doanh thu theo ngày ===
            const dailyCtx = document.getElementById('dailyRevenueChart');
            new Chart(dailyCtx, {
                type: 'line',
                data: {
                    labels: revenueByDay.map(r => r.date),
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenueByDay.map(r => r.total),
                        borderColor: '#36A2EB',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'VNĐ' } },
                        x: { title: { display: true, text: 'Ngày' } }
                    },
                    plugins: { legend: { display: true } }
                }
            });

            // === Biểu đồ doanh thu theo tháng ===
            const monthlyCtx = document.getElementById('monthlyRevenueChart');
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: revenueByMonth.map(r => 'Tháng ' + r.month),
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenueByMonth.map(r => r.total),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: '#FF6384',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true },
                        x: { title: { display: true, text: 'Tháng' } }
                    }
                }
            });

            // === Biểu đồ doanh thu theo năm ===
            const yearlyCtx = document.getElementById('yearlyRevenueChart');
            new Chart(yearlyCtx, {
                type: 'bar',
                data: {
                    labels: revenueByYear.map(r => r.year),
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenueByYear.map(r => r.total),
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: '#4BC0C0',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true },
                        x: { title: { display: true, text: 'Năm' } }
                    }
                }
            });
        </script>
        <script>
            // ======== DỮ LIỆU TỪ BACKEND ========
            const mostPurchased = {
                labels: {!! json_encode($mostPurchased->pluck('product.product_name')) !!},
                data: {!! json_encode($mostPurchased->pluck('total_qty')) !!}
            };
            const bestSelling = {
                labels: {!! json_encode($bestSelling->pluck('product.product_name')) !!},
                data: {!! json_encode($bestSelling->pluck('total_revenue')) !!}
            };
            const mostInStock = {
                labels: {!! json_encode($mostInStock->pluck('product_name')) !!},
                data: {!! json_encode($mostInStock->pluck('total_stock')) !!}
            };

            // ======== HÀM VẼ BIỂU ĐỒ CỘT ========
            function renderBarChart(canvasId, chartData, label, color, isMoney = false) {
                const ctx = document.getElementById(canvasId).getContext('2d');
                const maxValue = Math.max(...chartData.data);
                const roundedMax = isMoney
                    ? Math.ceil(maxValue / 10000) * 10000
                    : Math.ceil(maxValue / 10) * 10;
                const step = Math.ceil(roundedMax / 5);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: label,
                            data: chartData.data,
                            backgroundColor: color,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: roundedMax,
                                ticks: {
                                    stepSize: step,
                                    callback: function (value) {
                                        if (isMoney) {
                                            return value.toLocaleString('vi-VN') + ' ₫';
                                        } else {
                                            return value.toLocaleString('vi-VN');
                                        }
                                    }
                                },
                                grid: {
                                    color: '#eee'
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 0,
                                    minRotation: 0,
                                    font: { size: 10 },
                                    callback: function (value) {
                                        const label = this.getLabelForValue(value);
                                        const words = label.split(' ');
                                        const lines = [];
                                        let currentLine = '';

                                        words.forEach(word => {
                                            if ((currentLine + ' ' + word).trim().length > 5) {
                                                lines.push(currentLine.trim());
                                                currentLine = word;
                                            } else {
                                                currentLine += ' ' + word;
                                            }
                                        });

                                        if (currentLine) lines.push(currentLine.trim());
                                        return lines;
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const val = context.raw;
                                        return isMoney
                                            ? val.toLocaleString('vi-VN') + ' ₫'
                                            : val.toLocaleString('vi-VN');
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // ======== GỌI HÀM VẼ ========
            renderBarChart('mostPurchasedChart', mostPurchased, 'Số lượng mua', 'rgba(255, 99, 132, 0.6)');
            renderBarChart('bestSellingChart', bestSelling, 'Doanh thu (VNĐ)', 'rgba(54, 162, 235, 0.6)', true);
            renderBarChart('mostInStockChart', mostInStock, 'Số lượng tồn', 'rgba(255, 206, 86, 0.6)');
        </script>




        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection