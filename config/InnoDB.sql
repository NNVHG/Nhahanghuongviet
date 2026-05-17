CREATE DATABASE IF NOT EXISTS huongviet_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE huongviet_db;

-- Bảng Người dùng (Quản lý, Nhân viên)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('GiamDoc', 'TruongPhongKeToan', 'TruongPhongAmThuc', 'ThuNgan', 'PhucVu', 'LaoCong') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Bảng Khách hàng
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    customer_type ENUM('VangLai', 'VIP', 'KhachQuen') DEFAULT 'VangLai',
    points INT DEFAULT 0
) ENGINE=InnoDB;

-- Bảng Danh mục món ăn
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL -- Món xào, Món chiên, Món nướng, Món hấp...
) ENGINE=InnoDB;

-- Bảng Món ăn
CREATE TABLE dishes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    is_available BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Bảng Bàn ăn
CREATE TABLE dining_tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    status ENUM('Trong', 'DaDat', 'DangSuDung') DEFAULT 'Trong'
) ENGINE=InnoDB;

-- Bảng Đặt bàn
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    table_id INT NOT NULL,
    reservation_time DATETIME NOT NULL,
    status ENUM('ChoXacNhan', 'DaXacNhan', 'DaHuy', 'HoanThanh') DEFAULT 'ChoXacNhan',
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (table_id) REFERENCES dining_tables(id)
) ENGINE=InnoDB;

-- Bảng Kho hàng (Quản lý nhập kho)
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_name VARCHAR(100) NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    unit VARCHAR(20) NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;