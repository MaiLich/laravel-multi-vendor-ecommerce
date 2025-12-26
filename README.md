# Ứng dụng Thương mại Điện tử Đa nhà bán hàng Laravel (Dự án Lớn)
Ứng dụng Thương mại Điện tử Đa nhà bán hàng là một dự án/ứng dụng quy mô lớn được xây dựng bằng framework Laravel. Ứng dụng bao gồm các module và tính năng toàn diện, phong phú. Nó được thiết kế để cung cấp một nền tảng vững chắc giúp doanh nghiệp tạo ra chợ trực tuyến của riêng mình, cho phép nhiều nhà bán hàng (vendors) bán sản phẩm và quản lý cửa hàng của họ trên cùng một nền tảng. Ngoài ra, ứng dụng còn có API riêng biệt rất chi tiết và mạnh mẽ, yêu cầu xác thực bằng package Laravel Passport.

Công nghệ Frontend sử dụng: jQuery, AJAX, và nhiều thư viện/plugin JavaScript & jQuery khác.

## Các Tính năng Chính:
1- Tích hợp API bên thứ ba (Tích hợp Shiprocket API cho dịch vụ vận chuyển và quản lý đơn hàng).

2- Tích hợp Cổng thanh toán PayPal.

3- Tích hợp Cổng thanh toán Iyzico.

4- API riêng biệt với nhiều endpoint khác nhau dành cho ứng dụng.

5- Xác thực API bằng package Laravel Passport.

6- Triển khai Webhook để cập nhật tồn kho/số lượng hàng.

7- Sử dụng PHP cURL.

8- Đa xác thực (Multi Authentication) bằng Laravel Guards.

9- Quan hệ phân cấp đa cấp cho Danh mục (Multi-level Relationships/Categories).

10- Bộ lọc sản phẩm động (sử dụng AJAX).

11- Module Phí vận chuyển (tích hợp API dịch vụ bên thứ ba, tính phí theo trọng lượng sản phẩm và quốc gia, v.v.).

12- Hiển thị trạng thái vận chuyển đơn hàng.

13- Module Hoa hồng cho nhà bán hàng (Vendor Commissions).

14- Module Mã giảm giá (sử dụng một lần/nhiều lần, phần trăm/số tiền cố định).

15- Hệ thống Đánh giá sao và Bình luận.

16- Tính năng Sản phẩm đã xem gần đây.

17- Nhật ký/Lịch sử đơn hàng.

18- Các tính năng: Sản phẩm mới về, Sản phẩm giảm giá, Sản phẩm nổi bật, Sản phẩm tương tự, Sản phẩm bán chạy nhất.

19- Sử dụng các thư viện và package bên ngoài như 'Intervention Image' để xử lý hình ảnh, thư viện 'Dompdf' để in hóa đơn đơn hàng dưới dạng PDF, package 'Laravel Excel' để nhập/xuất bảng cơ sở dữ liệu dưới dạng file Excel, 'Laravel Barcode/QR Code Generator' để tạo mã vạch và QR code cho ID sản phẩm và Mã sản phẩm trên hóa đơn, v.v.

20- Sử dụng các thư viện JavaScript và plugin jQuery như 'DataTables' để thêm tương tác cho bảng HTML, 'EasyZoom' để phóng to hình ảnh sản phẩm, v.v.

21- Gửi Email xác nhận (Mailtrap) khi đăng ký, kích hoạt tài khoản và phê duyệt, cập nhật trạng thái vận chuyển đơn hàng, v.v.

22- Gửi SMS ngoại tuyến (khi đăng ký, bắt đầu quá trình vận chuyển đơn hàng, ...).

23- Hỗ trợ nhiều Địa chỉ giao hàng.

24- Chức năng Tìm kiếm sản phẩm trên website theo tên, màu sắc và mã sản phẩm.

25- Vai trò và Phân quyền Người dùng (superadmin, admins, vendors, users).

26- Phê duyệt đăng ký Người dùng và Nhà bán hàng bởi superadmin.

27- Chức năng Tải lên Hình ảnh & Video.

28- Tạo và chỉnh sửa động các Phần (Sections) và Danh mục (Categories).

29- Module Slider Banner động.

30- Điều hướng Breadcrumb động.

31- Thẻ Meta SEO/HTML động.

32- Đăng ký nhận Bản tin (Newsletter) qua email.

33- Sử dụng Biểu thức chính quy (Regular Expression).

34- Database Seeders.

35- Hàng chục yêu cầu jQuery AJAX (cập nhật mật khẩu admin qua AJAX, xác thực form bằng AJAX, ...).

36- Mini-Cart popup tùy chỉnh bằng AJAX.

37- Hiển thị màn hình Preloading khi submit form.

38- Tích hợp Trình soạn thảo TinyMCE WYSIWYG.

39- Sử dụng hai Favicon riêng biệt cho phần Frontend và Admin Panel.

## Hình ảnh Minh họa:
### Trang Chủ Phần Frontend:
![frontend-homepage](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/37646610-8c9f-4ac6-8a75-75e83cc469c7)

### Trang Danh sách Sản phẩm:
![frontend-product-listing-page](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/6a68ba25-ebd0-4b93-b687-487e35bf4912)

### Trang Giỏ hàng:
![shopping-cart-page](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/64f9cbbf-87d2-4f26-aaf1-5c942d1db85b)

### Trang Thanh toán:
![checkout-page](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/0e4057a8-dd7e-4db5-944d-8d8754b86c32)

### Trang Chủ Admin Panel:
![admin-panel-homepage](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/afda126b-2ab2-4ce8-9f42-2bd6eee36bfa)

### Trang Quản lý Sản phẩm trong Admin Panel:
![admin-panel-products-management](https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application/assets/118033266/06d8fd5b-6538-4574-b6f4-c3bf4a6a5c32)

## Đường dẫn Ứng dụng:
1- **Frontend**: Website công khai có thể truy cập tại http://127.0.0.1:8000/. Đây là nơi người dùng/khách hàng/thành viên có thể xem danh mục, sản phẩm và tương tác với website. Phần Frontend thường mở cho mọi khách truy cập.

2- **Admin Panel**: Bảng quản trị ứng dụng truy cập tại http://127.0.0.1:8000/admin/login. Khu vực bảo mật này chỉ dành cho quản trị viên được ủy quyền (superadmin, admins và vendors đã xác thực). Nó cung cấp quyền truy cập vào các chức năng quản trị như thêm sản phẩm mới, quản lý đơn hàng, quản lý người dùng, tạo/sửa các phần và danh mục website, quản lý vận chuyển đơn hàng, v.v.

## Routes và API Endpoints của Ứng dụng:
Tất cả routes ứng dụng và API endpoints được định nghĩa trong file **[web.php](routes/web.php)** (routes cho Frontend và Admin Panel) và file **[api.php](routes/api.php)** (API Endpoints).

## API Endpoints:
> ***\*\* Xem bộ sưu tập API của ứng dụng trên Postman Profile của tôi: https://www.postman.com/ahmed-yahya/workspace/my-public-portfolio-postman-workspace/collection/28181483-179adc20-2dcc-426c-a755-5a48da9ca7a4***

> ***\*\* Bạn cũng có thể tự kiểm tra các API Endpoints bằng Postman. Đây là file .json của Postman Collection [API Postman Collection file](<Postman Collection of API Endpoints/Multi-vendor E-commerce Application API.postman_collection.json>) mà bạn có thể tải về và import vào Postman.***

## Hướng dẫn Cài đặt & Cấu hình:

1- Mở terminal, sử dụng lệnh '***git clone https://github.com/AhmedYahyaE/laravel-multi-vendor-e-commerce-application.git***' hoặc tải file ZIP dự án về.

2- Di chuyển (bằng lệnh **cd**) vào thư mục gốc dự án, sau đó chạy lệnh '***composer install***'.

3- Chạy lệnh '***npm install***' (nếu gặp lỗi, chạy 'npm audit fix'), sau đó chạy '***npm run build***'.

4- Tạo cơ sở dữ liệu MySQL có tên **\`multivendor_ecommerce\`**, sau đó import file **[multivendor_ecommerce database SQL Dump File](<Database - multivendor_ecommerce/multivendor_ecommerce database - SQL Dump File - phpMyAdmin Export.sql>)** vào cơ sở dữ liệu này.

5- Mở file **[.env](.env)** và cấu hình/cập nhật thông tin kết nối MySQL cùng các thiết lập khác.

6- Chạy lệnh '***php artisan serve***', sau đó mở trình duyệt truy cập **http://127.0.0.1:8000** để vào phần Frontend, hoặc **http://127.0.0.1:8000/admin/login** để vào Admin Panel.

\*\* Tài khoản đăng nhập sẵn có để bạn thử nghiệm:
> 1) Superadmin (đăng nhập Admin Panel): Email: **admin@admin.com**, Mật khẩu: **123456**

> 2) Vendor (đăng nhập Admin Panel): Email: **yasser@admin.com**, Mật khẩu: **123456**
    
> 3) User (đăng nhập Frontend): Email: **ibrahim@gmail.com**, Mật khẩu: **123456**

## Đóng góp:
Rất hoan nghênh mọi đóng góp cho dự án Thương mại Điện tử Đa nhà bán hàng Laravel của tôi! Nếu bạn phát hiện lỗi, có ý tưởng cải tiến hoặc muốn thêm tính năng mới, vui lòng mở issue hoặc gửi pull request.
