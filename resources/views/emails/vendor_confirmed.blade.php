{{-- This is the vendor confirmation/registration Success Mail file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the vendorRegister() method in Front/VendorController.php --}}


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <tr><td>Kính gửi {{ $name }}!</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Email nhà bán hàng của bạn đã được xác nhận. Vui lòng đăng nhập và bổ sung thông tin cá nhân, doanh nghiệp và ngân hàng để tài khoản của bạn được phê duyệt.</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thông tin tài khoản nhà bán hàng của bạn như sau :-<br></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Họ và tên: {{ $name }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Số điện thoại: {{ $mobile }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Mật khẩu: ***** (do bạn đã chọn)</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Trân trọng,</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Ứng dụng Thương mại điện tử đa nhà bán</td></tr>
    </body>
</html>
