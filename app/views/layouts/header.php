<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ẩm Thực Hương Việt Bến Cát | Cá Lóc Rút Xương & Quán Ăn Gia Đình</title>
    <meta name="description" content="Ẩm Thực Hương Việt chuyên phục vụ món ăn gia đình đặc sắc, cá lóc rút xương nhồi thịt, các gói combo tiệc gia đình, hội họp với chất lượng và dịch vụ tốt nhất tại Bến Cát, Bình Dương.">
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php 
    // Determine active menu state based on GET parameter
    $activePage = isset($_GET['url']) ? $_GET['url'] : 'home';
    ?>

    <!-- Main Header -->
    <header class="main-header">
        <!-- Top bar with contact info & address -->
        <div class="header-top">
            <div class="wrap-content flex-between">
                <div class="header-left">
                    <div class="address-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Đường DJ 10, KDC Mỹ Phước 3, P. Thới Hòa, TP. Bến Cát, Bình Dương</p>
                    </div>
                    <span class="open-time"><i class="far fa-clock"></i> Open: 6:00 AM - 21:00 PM</span>
                </div>

                <div class="header-right">
                    <div class="hotline-box">
                        <img src="https://amthuchuongviet.com.vn/assets/images/hd1.png" alt="Delivery" class="delivery-icon" style="display:none;">
                        <div class="hotline-text">
                            <span>Hotline đặt bàn:</span>
                            <a href="tel:0988659291" class="phone-number">0988.659.291</a>
                        </div>
                    </div>
                    <button class="btn-datban" onclick="document.getElementById('booking-section').scrollIntoView({behavior: 'smooth'})">Đặt Bàn Ngay</button>
                </div>
            </div>
        </div>

        <!-- Middle brand Logo bar (centered like the original site) -->
        <div class="header-center" style="padding: 15px 0; background-color: #ffffff;">
            <div class="wrap-content" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <a href="?url=home" class="logo-link">
                    <img src="https://amthuchuongviet.com.vn/thumbs/235x110x2/upload/photo/huong-viet-235-x-110-px-6751.png" alt="Hương Việt Logo">
                </a>
                <h1 class="site-title">ẨM THỰC HƯƠNG VIỆT BẾN CÁT</h1>
            </div>
        </div>

        <!-- Desktop Navigation Menu -->
        <nav class="main-menu">
            <div class="wrap-content">
                <ul class="nav-list">
                    <li><a href="?url=home" class="<?= $activePage == 'home' ? 'active' : '' ?>">TRANG CHỦ</a></li>
                    <li><a href="?url=gioi-thieu" class="<?= $activePage == 'gioi-thieu' ? 'active' : '' ?>">GIỚI THIỆU</a></li>
                    <li>
                        <a href="?url=menu" class="<?= strpos($activePage, 'menu') !== false ? 'active' : '' ?>">
                            MENU <i class="fas fa-chevron-down" style="font-size: 11px; margin-left: 3px;"></i>
                        </a>
                        <ul>
                            <li><a href="?url=menu#mon-dac-san">Món Đặc Sản</a></li>
                            <li><a href="?url=menu#mon-goi">Món Gỏi</a></li>
                            <li><a href="?url=menu#mon-hap">Món Hấp</a></li>
                            <li><a href="?url=menu#mon-luoc-khai-vi">Món Luộc - Khai Vị</a></li>
                            <li><a href="?url=menu#mon-chien-xao">Món Chiên - Xào</a></li>
                            <li><a href="?url=menu#mon-nuong">Món Nướng</a></li>
                            <li><a href="?url=menu#mon-lau">Món Lẩu</a></li>
                        </ul>
                    </li>
                    <li><a href="?url=combo" class="<?= $activePage == 'combo' ? 'active' : '' ?>">BÀN TIỆC - COMBO</a></li>
                    <li><a href="?url=album" class="<?= $activePage == 'album' ? 'active' : '' ?>">ALBUM</a></li>
                    <li><a href="?url=tin-tuc" class="<?= $activePage == 'tin-tuc' ? 'active' : '' ?>">TIN TỨC</a></li>
                    <li><a href="?url=lien-he" class="<?= $activePage == 'lien-he' ? 'active' : '' ?>">LIÊN HỆ</a></li>
                </ul>
            </div>
        </nav>

        <!-- Mobile Navigation Menu -->
        <div class="menu_mobi">
            <div class="icon_menu_mobi" onclick="toggleMobileMenu()"><i class="fas fa-bars"></i></div>
            <a href="?url=home" class="logo-mb" style="display: block;">
                <img src="https://amthuchuongviet.com.vn/thumbs/235x110x2/upload/photo/huong-viet-235-x-110-px-6751.png" alt="Ẩm Thực Hương Việt" style="height: 40px;">
            </a>
            <div class="db_menu">
                <a class="btn-datban" style="padding: 6px 12px; font-size: 11px;" onclick="document.getElementById('booking-section').scrollIntoView({behavior: 'smooth'})">ĐẶT BÀN</a>
            </div>
        </div>

        <!-- Mobile Menu Overlay Panel -->
        <div class="menu_mobi_add" id="mobileMenuPanel" style="display: none; position: fixed; top: 0; left: -280px; width: 280px; height: 100%; background: #ffffff; z-index: 10000; box-shadow: 5px 0 15px rgba(0,0,0,0.15); transition: left 0.3s ease; padding: 25px 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <h3 style="font-family: var(--font-heading); color: var(--primary);">Danh Mục</h3>
                <span onclick="toggleMobileMenu()" style="font-size: 24px; cursor: pointer; color: var(--accent); font-weight: bold;">&times;</span>
            </div>
            <ul style="display: flex; flex-direction: column; gap: 15px; font-family: var(--font-alt); font-weight: 600;">
                <li><a href="?url=home" style="color: var(--dark);">TRANG CHỦ</a></li>
                <li><a href="?url=gioi-thieu" style="color: var(--dark);">GIỚI THIỆU</a></li>
                <li><a href="?url=menu" style="color: var(--dark);">MENU</a></li>
                <li><a href="?url=combo" style="color: var(--dark);">BÀN TIỆC - COMBO</a></li>
                <li><a href="?url=album" style="color: var(--dark);">ALBUM</a></li>
                <li><a href="?url=tin-tuc" style="color: var(--dark);">TIN TỨC</a></li>
                <li><a href="?url=lien-he" style="color: var(--dark);">LIÊN HỆ</a></li>
            </ul>
            <div class="thongtin-mb" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 25px; font-size: 13.5px; color: #666; display: flex; flex-direction: column; gap: 12px;">
                <p><i class="fas fa-map-marker-alt" style="color: var(--accent); margin-right: 8px;"></i> Đường DJ 10, KDC Mỹ Phước 3, Bến Cát</p>
                <p><i class="fas fa-phone-volume" style="color: var(--secondary); margin-right: 8px;"></i> 0988.659.291</p>
                <p><i class="fas fa-envelope" style="color: var(--primary); margin-right: 8px;"></i> quananhuongviet123@gmail.com</p>
            </div>
        </div>
    </header>

    <script>
        function toggleMobileMenu() {
            var menu = document.getElementById('mobileMenuPanel');
            if(menu.style.display === 'none' || menu.style.left === '-280px') {
                menu.style.display = 'block';
                setTimeout(function() {
                    menu.style.left = '0';
                }, 10);
            } else {
                menu.style.left = '-280px';
                setTimeout(function() {
                    menu.style.display = 'none';
                }, 300);
            }
        }
    </script>