{{-- This is the User Welcome E-mail after Registration file using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the userRegister() method in Front/UserController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>



        <table>
            <tr><td>Kính gửi {{ $name }},</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Chào mừng bạn đến với Ứng dụng Thương mại điện tử đa nhà bán. Tài khoản của bạn đã được tạo thành công với các thông tin sau:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Họ và tên: {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Số điện thoại: {{ $mobile }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Mật khẩu: ****** (do bạn đã chọn)</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Trân trọng,</td></tr>
            <tr><td>Ứng dụng Thương mại điện tử đa nhà bán</td></tr>
        </table>



    </body>
</html>
