{{-- User Confirmation Email after Registration --}}
{{-- Variables ($name, $email, $code, ...) are passed from userRegister() in Front/UserController.php --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận tài khoản của bạn</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 30px;
        }
        .email-container {
            background-color: #fff;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Chào mừng bạn đến với Ứng dụng Thương mại điện tử đa nhà bán!</h2>

        <p>Xin chào <strong>{{ $name }}</strong>,</p>

        <p>Cảm ơn bạn đã đăng ký tài khoản tại <strong>Ứng dụng Thương mại điện tử đa nhà bán</strong>.</p>

        <p>Vui lòng nhấn vào nút bên dưới để kích hoạt tài khoản của bạn:</p>

        <p style="text-align:center; margin: 25px 0;">
            <a href="{{ url('/user/confirm/' . $code) }}" class="btn">Kích hoạt tài khoản</a>
        </p>

        <p>Nếu bạn không thực hiện đăng ký này, vui lòng bỏ qua email này.</p>

        <div class="footer">
            <p>Trân trọng,<br><strong>Đội ngũ Ứng dụng Thương mại điện tử đa nhà bán</strong></p>
        </div>
    </div>
</body>
</html>
