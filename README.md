# 🍲 Ẩm Thực Hương Việt - Website Nhà Hàng Gia Đình Premium

Chào mừng bạn đến với dự án **Ẩm Thực Hương Việt Bến Cát**. Đây là một ứng dụng web hoàn chỉnh phục vụ hoạt động đặt bàn trực tuyến, giới thiệu thực đơn đặc sản và suite quản trị nhà hàng đa vai trò, được xây dựng trên nền tảng **PHP thuần (MVC & OOP)** kết hợp cơ sở dữ liệu **MySQL (InnoDB Engine)** an toàn giao dịch.

---

## 🌟 1. Tính Năng Nổi Bật

### 🌐 Phân Hệ Khách Hàng (Client-Side)
*   **Giao Diện Premium:** Thiết kế sang trọng, ấm cúng và tương thích mọi thiết bị (Responsive) theo chuẩn nhận diện của chuỗi nhà hàng Hương Việt.
*   **Thực Đơn Đa Dạng (Menu):** Phân chia nhóm món ăn trực quan (Món đặc sản, Món hấp, Món nướng, Món lẩu...).
*   **Đặt Bàn An Toàn (PDO Transactions):** Form đặt thố tiệc thông minh, tích hợp giao dịch PDO an toàn chống hiện tượng đặt trùng bàn hoặc tranh chấp dữ liệu khi nhiều người dùng thao tác đồng thời.
*   **Chính Sách Khách Hàng Thân Thiết:** Tự động nhận diện số điện thoại để phân nhóm khách hàng và áp dụng giảm giá trực tiếp:
    *   👑 **Khách VIP:** Giảm giá **15%** hóa đơn.
    *   👍 **Khách Quen:** Giảm giá **5%** hóa đơn.
    *   👤 **Khách Vãng Lai:** Nguyên giá.

### 🔐 Phân Hệ Quản Trị (Admin Suite)
*   **Cơ Chế Khóa Bảo Mật (Role-Based Access Control - RBAC):** Phân quyền tự động theo vai trò của từng nhóm nhân viên quản trị.
*   **Bảng Điều Khiển Đăng Nhập Giả Lập:** Tiết kiệm thời gian thử nghiệm với bảng **Quick Login 1-Click** ngay tại màn hình đăng nhập.
*   **Các Module Chuyên Biệt:**
    1.  **Quản Lý Đặt Bàn:** Phê duyệt/Hủy yêu cầu đặt bàn và tự động đồng bộ hóa trạng thái bàn ăn (Trống <-> Đã Đặt).
    2.  **Quản Lý Nhân Sự:** Thêm mới, cập nhật danh sách nhân sự của nhà hàng.
    3.  **Quản Lý Kho Nguyên Liệu:** Nhập kho và theo dõi mức tồn kho nguyên vật liệu tươi sống phục vụ chế biến món ăn.
    4.  **Báo Cáo Thống Kê Sinh Động:** Tổng hợp lượng khách, doanh thu mô phỏng và hiển thị biểu đồ phân tích trực quan bằng CSS thuần.

---

## 🛠️ 2. Công Nghệ Sử Dụng

*   **Ngôn ngữ lập trình:** PHP 7.4+ (OOP, MVC, PDO Transactions).
*   **Cơ sở dữ liệu:** MySQL (InnoDB Storage Engine bảo toàn toàn vẹn dữ liệu).
*   **Thiết kế giao diện:** HTML5, CSS3 Vanilla (Thiết kế tùy chỉnh cao cấp), JavaScript (ES6).
*   **Icon & Typography:** Google Fonts (Outfit, Inter, Playfair Display), FontAwesome 5.

---

## 📂 3. demo


---

## 📂 4. Cấu Trúc Thư Mục Dự Án

```text
Nhahanghuongviet/
├── app/
│   ├── controllers/      # Bộ điều hướng logic
│   │   ├── AdminController.php
│   │   ├── HomeController.php
│   │   ├── MenuController.php
│   │   └── ReservationController.php
│   ├── models/           # Lớp nghiệp vụ đối tượng và CSDL
│   │   ├── Customer.php
│   │   ├── Dish.php
│   │   ├── DishManager.php
│   │   └── User.php
│   └── views/            # Giao diện hiển thị
│       ├── admin/        # Giao diện suite quản trị
│       ├── home/         # Giao diện trang chủ
│       ├── layouts/      # Layout dùng chung (header, footer)
│       └── menu/         # Giao diện thực đơn
├── config/
│   ├── setup_db.php      # Công cụ khởi tạo và seeder CSDL tự động
│   └── InnoDB.sql        # Bản thiết kế cấu trúc database
├── includes/
│   └── db_connect.php    # Kết nối PDO MySQL bảo mật
├── public/
│   ├── assets/           # Tài nguyên tĩnh (CSS, JS, hình ảnh)
│   └── index.php         # Entrypoint tập trung và Router
└── README.md             # Hướng dẫn dự án này
```

---

## 🚀 5. Hướng Dẫn Cài Đặt Nhanh

### Bước 1: Chuẩn bị môi trường
1.  Tải và cài đặt phần mềm **XAMPP** (hỗ trợ PHP 7.4 trở lên).
2.  Khởi động module **Apache** và **MySQL** trên XAMPP Control Panel.
3.  Di chuyển toàn bộ thư mục `Nhahanghuongviet` vào thư mục `htdocs` của XAMPP:
    `C:\xampp\htdocs\Nhahanghuongviet` (hoặc phân vùng đĩa tương ứng của bạn).

### Bước 2: Tạo Cơ Sở Dữ Liệu Tự Động (Database Initialization)
Dự án tích hợp sẵn script thiết lập tự động vô cùng nhanh chóng. Bạn có hai cách khởi chạy:

*   **Cách 1 (Qua Trình Duyệt):** Truy cập liên kết sau:
    `http://localhost/Nhahanghuongviet/public/index.php?url=setup-db`
*   **Cách 2 (Qua Dòng Lệnh CLI):** Chạy lệnh sau từ terminal:
    `E:\XAMPP\php\php.exe config/setup_db.php`

> [!NOTE]
> Hệ thống sẽ tự động tạo cơ sở dữ liệu `huongviet_db` (InnoDB) và nạp toàn bộ thực đơn, bàn ăn mẫu, tài khoản quản trị và lượng tồn kho mẫu khởi điểm.

---

## 🔑 6. Danh Sách Tài Khoản Thử Nghiệm

Hệ thống phân quyền tự động theo vai trò, bạn có thể đăng nhập bằng các tài khoản sau tại trang `http://localhost/Nhahanghuongviet/public/index.php?url=admin/login`:

| Tài khoản | Mật khẩu | Chức vụ | Quyền truy cập hiển thị |
| :--- | :--- | :--- | :--- |
| **`admin`** | `admin123` | **👑 Giám Đốc** | Toàn quyền (Nhân sự, Đặt bàn, Nhập kho, Báo cáo) |
| **`ketoan`** | `ketoan123` | **💼 Kế Toán Trưởng** | Xem báo cáo thống kê & Quản lý nhân viên |
| **`amthuc`** | `amthuc123` | **🍳 Trưởng Phòng Ẩm Thực** | Xử lý đơn đặt bàn & Quản lý nhập kho nguyên liệu |
| **`thungan`** | `thungan123` | **💵 Thu Ngân** | Xem và cập nhật trạng thái đặt bàn |
| **`phucvu`** | `phucvu123` | **⚡ Phục Vụ** | Xem danh sách đặt bàn tiệc |

---

## 🏆 7. Tính Đảm Bảo Khoa Học & Chuẩn Đầu Ra Học Phần
*   **Lập trình Hướng Đối Tượng (OOP):** Triển khai lớp trừu tượng (`abstract class User`), kế thừa (`class Manager extends User`), đa hình và đóng gói an toàn.
*   **Mô hình MVC phân tách rõ ràng:** Controller tiếp nhận yêu cầu, tương tác Model lấy dữ liệu, nạp View hiển thị, đảm bảo không chồng chéo logic.
*   **Bảo mật dữ liệu:** Kết nối PDO chuẩn hóa chống SQL Injection, ràng buộc khóa ngoại (Foreign Keys) tự động đồng bộ khi sửa/xóa liên kết (`ON DELETE CASCADE`).
