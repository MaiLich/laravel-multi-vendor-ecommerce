{{-- This is the User Forgot Password E-mail using Mailtrap --}} 
{{-- All the variables (like $name, $mobile, $email, $code, ...) used here are passed in from the forgotPassword() method in Front/UserController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Khôi phục mật khẩu</title>
    </head>
    <body>

        <table>
            <tr><td>Kính gửi {{ $name }},</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Quý khách đã yêu cầu thay đổi mật khẩu. Mật khẩu mới của quý khách như sau:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr> {{-- $email is passed in from forgotPassword() method in UserController.php --}}
            <tr><td>&nbsp;</td></tr>
            <tr><td>Mật khẩu: {{ $password }}</td></tr> {{-- $password is passed in from forgotPassword() method in UserController.php --}}
            <tr><td>&nbsp;</td></tr>
            <tr><td>Trân trọng,</td></tr>
            <tr><td>Ứng dụng Thương mại Điện tử Đa nhà bán hàng</td></tr>
        </table>

    </body>
</html>