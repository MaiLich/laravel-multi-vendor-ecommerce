{{-- This is the order "Update Order Status" by 'admin' email file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the updateOrderStatus() method in Admin/OrderController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table style="width: 700px">
            <tr><td>&nbsp;</td></tr>
            <tr><td><img src="{{ asset('front/images/main-logo/main-logo.png') }}"></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Xin chào {{ $name }}</td></tr>
            <tr><td>&nbsp;<br></td></tr>
            <tr><td>Trạng thái đơn hàng #{{ $order_id }} của bạn đã được cập nhật thành {{ $order_status }}</td></tr>
            <tr><td>&nbsp;</td></tr>

            
            @if (!empty($courier_name) && !empty($tracking_number))
                <tr>
                    <td>Tên đơn vị vận chuyển là {{ $courier_name }} và mã vận đơn là {{ $tracking_number }}</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            @endif

            <tr><td>Chi tiết đơn hàng của bạn như sau:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>
                <table style="width: 95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Tên sản phẩm</td>
                        <td>Mã sản phẩm</td>
                        <td>Kích thước</td>
                        <td>Màu sắc</td>
                        <td>Số lượng</td>
                        <td>Giá sản phẩm</td>
                    </tr>
                    @foreach ($orderDetails['orders_products'] as $order)
                        <tr bgcolor="#f9f9f9">
                            <td>{{ $order['product_name'] }}</td>
                            <td>{{ $order['product_code'] }}</td>
                            <td>{{ $order['product_size'] }}</td>
                            <td>{{ $order['product_color'] }}</td>
                            <td>{{ $order['product_qty'] }}</td>
                            <td>{{ $order['product_price'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right">Phí vận chuyển</td>
                        <td>INR {{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Giảm giá coupon</td>
                        <td>
                            INR
                            @if ($orderDetails['coupon_amount'] > 0)
                                {{ $orderDetails['coupon_amount'] }}
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Tổng thanh toán</td>
                        <td>INR {{ $orderDetails['grand_total'] }}</td>
                    </tr>
                </table>
            </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>
                <table>
                    <tr>
                        <td><strong>Địa chỉ giao hàng:</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['city'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['state'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['country'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['pincode'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $orderDetails['mobile'] }}</td>
                    </tr>
                </table>    
            </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Nếu có bất kỳ thắc mắc nào, bạn có thể liên hệ với chúng tôi qua <a href="mailto:info@MultiVendorEcommerceApplication.com.eg">info@MultiVendorEcommerceApplication.com.eg</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Trân trọng,<br>Đội ngũ Multi-vendor E-commerce Application</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>
    </body>
</html>
