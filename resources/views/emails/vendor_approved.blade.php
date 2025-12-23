{{-- This is the vendor Approval Success Mail file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the updateAdminStatus() method in Admin/AdminController.php --}}


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <tr><td>Kính gửi {{ $name }}!</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Tài khoản nhà bán hàng của bạn đã được phê duyệt. Bây giờ bạn có thể đăng nhập và thêm sản phẩm.</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Thông tin tài khoản nhà bán hàng của bạn như sau :-<br></td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Họ và tên: {{ $name }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Số điện thoại: {{ $mobile }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Mật khẩu: ***** (do bạn đã chọn)</td></tr>
        <tr><td>&nbsp;<br><br></td></tr>
        <tr><td>Trân trọng,</td></tr>
        <tr><td>&nbsp;<br></td></tr>
        <tr><td>Ứng dụng Thương mại điện tử đa nhà bán</td></tr>
    </body>
</html>
