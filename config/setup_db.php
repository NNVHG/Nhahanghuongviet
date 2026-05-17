<?php
// config/setup_db.php
// Automated Database Setup and Seeder Tool for Ẩm Thực Hương Việt

$host = '127.0.0.1';
$user = 'root';
$pass = '';

try {
    // 1. Establish connection to MySQL without selecting database
    $conn = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Create database
    $conn->exec("CREATE DATABASE IF NOT EXISTS huongviet_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $conn->exec("USE huongviet_db;");

    // 3. Drop existing tables to ensure a clean slate
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $conn->exec("DROP TABLE IF EXISTS inventory;");
    $conn->exec("DROP TABLE IF EXISTS reservations;");
    $conn->exec("DROP TABLE IF EXISTS dining_tables;");
    $conn->exec("DROP TABLE IF EXISTS dishes;");
    $conn->exec("DROP TABLE IF EXISTS categories;");
    $conn->exec("DROP TABLE IF EXISTS customers;");
    $conn->exec("DROP TABLE IF EXISTS users;");
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // 4. Create Tables
    $conn->exec("
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            role ENUM('GiamDoc', 'TruongPhongKeToan', 'TruongPhongAmThuc', 'ThuNgan', 'PhucVu', 'LaoCong') NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE customers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(100) NOT NULL,
            phone VARCHAR(20) UNIQUE NOT NULL,
            customer_type ENUM('VangLai', 'VIP', 'KhachQuen') DEFAULT 'VangLai',
            points INT DEFAULT 0
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE dishes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category_id INT NOT NULL,
            name VARCHAR(150) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            description TEXT,
            is_available BOOLEAN DEFAULT TRUE,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE dining_tables (
            id INT AUTO_INCREMENT PRIMARY KEY,
            table_name VARCHAR(50) NOT NULL,
            capacity INT NOT NULL,
            status ENUM('Trong', 'DaDat', 'DangSuDung') DEFAULT 'Trong'
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE reservations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT NOT NULL,
            table_id INT NOT NULL,
            reservation_time DATETIME NOT NULL,
            status ENUM('ChoXacNhan', 'DaXacNhan', 'DaHuy', 'HoanThanh') DEFAULT 'ChoXacNhan',
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
            FOREIGN KEY (table_id) REFERENCES dining_tables(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;
    ");

    $conn->exec("
        CREATE TABLE inventory (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ingredient_name VARCHAR(100) NOT NULL,
            quantity DECIMAL(10,2) NOT NULL,
            unit VARCHAR(20) NOT NULL,
            last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ");

    // 5. Seed Users
    $stmtUser = $conn->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");
    $stmtUser->execute(['admin', 'admin123', 'Giám Đốc Nguyễn Hương Việt', 'GiamDoc']);
    $stmtUser->execute(['ketoan', 'ketoan123', 'Trần Thu Hà', 'TruongPhongKeToan']);
    $stmtUser->execute(['amthuc', 'amthuc123', 'Phạm Tuấn Anh', 'TruongPhongAmThuc']);
    $stmtUser->execute(['thungan', 'thungan123', 'Lê Thị Hoa', 'ThuNgan']);
    $stmtUser->execute(['phucvu', 'phucvu123', 'Nguyễn Văn Hùng', 'PhucVu']);

    // 6. Seed Customers
    $stmtCustomer = $conn->prepare("INSERT INTO customers (full_name, phone, customer_type, points) VALUES (?, ?, ?, ?)");
    $stmtCustomer->execute(['Lâm Gia Bảo', '0911223344', 'VIP', 1200]);
    $stmtCustomer->execute(['Trần Minh Triết', '0988776655', 'KhachQuen', 550]);
    $stmtCustomer->execute(['Nguyễn Thị Lan', '0909090909', 'VangLai', 0]);

    // 7. Seed Categories
    $stmtCat = $conn->prepare("INSERT INTO categories (id, name) VALUES (?, ?)");
    $stmtCat->execute([1, 'Món Đặc Sản']);
    $stmtCat->execute([2, 'Món Gỏi']);
    $stmtCat->execute([3, 'Món Hấp']);
    $stmtCat->execute([4, 'Món Luộc - Khai Vị']);
    $stmtCat->execute([5, 'Món Chiên - Xào']);
    $stmtCat->execute([6, 'Món Nướng']);
    $stmtCat->execute([7, 'Món Lẩu']);

    // 8. Seed Dishes
    $stmtDish = $conn->prepare("INSERT INTO dishes (category_id, name, price, description) VALUES (?, ?, ?, ?)");
    $stmtDish->execute([1, 'Cá lóc rút xương nhồi thịt cuốn bánh tráng', 260000, 'Cá lóc đồng làm sạch xương, nhồi thịt băm chiên giòn.']);
    $stmtDish->execute([1, 'Vịt trời 3 món đặc sản', 750000, 'Gồm lòng xào mướp, nướng sả và lẩu vịt trời măng chua.']);
    $stmtDish->execute([2, 'Gà ta luộc bóp gỏi hành tây', 320000, 'Gà ta thả vườn dai ngọt trộn rau răm hành tây chua ngọt.']);
    $stmtDish->execute([3, 'Gà tre hấp nước mắm nhĩ tỏi', 250000, 'Gà tre hấp mắm nhĩ Phú Quốc thơm ngon đậm vị.']);
    $stmtDish->execute([3, 'Nghêu tươi hấp sả ớt cay', 100000, 'Nghêu hấp thố sả ớt cay nồng ấm nóng ngày đông.']);
    $stmtDish->execute([4, 'Đậu bắp luộc chấm kho quẹt', 80000, 'Đậu bắp tươi luộc chấm nước kho quẹt tóp mỡ tôm khô.']);
    $stmtDish->execute([5, 'Đậu hũ chiên giòn muối sả', 60000, 'Đậu hũ non chiên xốp vàng ruộm chấm tương ớt sả băm.']);
    $stmtDish->execute([6, 'Cá tầm nướng muối ớt', 350000, 'Thịt cá tầm dai ngọt nướng trên than hồng thơm muối ớt.']);
    $stmtDish->execute([7, 'Lẩu cua đồng hải sản đặc biệt', 280000, 'Nước dùng riêu cua đồng béo ngậy kèm tôm, mực tươi sống.']);

    // 9. Seed Dining Tables
    $stmtTable = $conn->prepare("INSERT INTO dining_tables (table_name, capacity, status) VALUES (?, ?, ?)");
    $stmtTable->execute(['Bàn Gia Đình 1', 4, 'Trong']);
    $stmtTable->execute(['Bàn Gia Đình 2', 4, 'Trong']);
    $stmtTable->execute(['Bàn Sân Vườn 1', 6, 'Trong']);
    $stmtTable->execute(['Bàn Sân Vườn 2', 8, 'Trong']);
    $stmtTable->execute(['Bàn Hội Nghị VIP 1', 12, 'Trong']);

    // 10. Seed Reservations
    $stmtRes = $conn->prepare("INSERT INTO reservations (customer_id, table_id, reservation_time, status) VALUES (?, ?, ?, ?)");
    $stmtRes->execute([1, 5, '2026-05-20 18:30:00', 'ChoXacNhan']);
    $stmtRes->execute([2, 1, '2026-05-18 19:00:00', 'DaXacNhan']);

    // 11. Seed Inventory
    $stmtInv = $conn->prepare("INSERT INTO inventory (ingredient_name, quantity, unit) VALUES (?, ?, ?)");
    $stmtInv->execute(['Cá lóc đồng tươi', 50.0, 'kg']);
    $stmtInv->execute(['Gà tre thả vườn', 35.0, 'con']);
    $stmtInv->execute(['Nghêu cát sông', 20.0, 'kg']);
    $stmtInv->execute(['Xoài cát xanh', 15.5, 'kg']);

    // Render success feedback
    require_once '../app/views/layouts/header.php';
    ?>
    <main style="padding: 100px 0; background-color: #faf7f2; text-align: center;">
        <div class="wrap-content" style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 50px; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.06); border-top: 4px solid var(--secondary);">
            <div style="width: 80px; height: 80px; background-color: rgba(39, 174, 96, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                <i class="fas fa-database" style="font-size: 36px; color: var(--secondary);"></i>
            </div>
            
            <h2 style="font-family: var(--font-heading); color: var(--primary); font-size: 28px; margin-bottom: 15px; text-transform: uppercase;">KHỞI TẠO CƠ SỞ DỮ LIỆU THÀNH CÔNG!</h2>
            <p style="color: #666; margin-bottom: 30px; line-height: 1.6;">Đã tạo thành công cơ sở dữ liệu <strong>huongviet_db</strong> (định dạng InnoDB) và nạp đầy đủ các bảng dữ liệu tĩnh, thực đơn đặc sản, bàn ăn, tài khoản nhân viên quản trị và tồn kho nguyên liệu.</p>
            
            <div style="text-align: left; background: #fdfcf7; padding: 20px; border-radius: 8px; border: 1px dashed rgba(211, 84, 0, 0.2); margin-bottom: 30px; font-size: 13.5px;">
                <p style="margin-bottom: 5px;">🔑 <strong>Tài khoản Giám Đốc:</strong> admin / admin123</p>
                <p style="margin-bottom: 5px;">🔑 <strong>Tài khoản Kế Toán:</strong> ketoan / ketoan123</p>
                <p style="margin-bottom: 5px;">🔑 <strong>Tài khoản Trưởng Bếp:</strong> amthuc / amthuc123</p>
                <p style="margin-bottom: 0;">🔑 <strong>Tài khoản Thu Ngân:</strong> thungan / thungan123</p>
            </div>
            
            <a href="?url=admin/login" class="btn-datban" style="padding: 12px 35px; border-radius: 4px; display: inline-block;">ĐĂNG NHẬP ADMIN NGAY</a>
        </div>
    </main>
    <?php
    require_once '../app/views/layouts/footer.php';
} catch (PDOException $e) {
    echo "<div style='padding:50px; background:#fdf2f2; color:#ec5b5b; border-radius:6px; font-family:sans-serif;'>";
    echo "<h3>Lỗi kết nối hoặc khởi tạo CSDL:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Vui lòng đảm bảo rằng ứng dụng MySQL đã được kích hoạt trên XAMPP Control Panel!</p>";
    echo "</div>";
}
