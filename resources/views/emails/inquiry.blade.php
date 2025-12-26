{{-- This is the front/pages/contact.blade.php HTML Form, i.e. the user's inquiry to the 'admin' sent to the 'admin' as an email using Mailtrap --}} {{-- All the variables (like $name, $mobile, $email, ...) used here are passed in from the contact() method in Front/CmsController.php --}}



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr><td>Kính gửi Quản trị viên!</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Yêu cầu liên hệ của người dùng trên website Ứng dụng Thương mại điện tử đa nhà bán, trang Liên hệ. Chi tiết như sau:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Họ và tên: {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Chủ đề: {{ $subject }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Nội dung: {{ $comment }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Trân trọng,</td></tr>
            <tr><td>Ứng dụng Thương mại điện tử đa nhà bán</td></tr>
        </table>
    </body>
</html>
