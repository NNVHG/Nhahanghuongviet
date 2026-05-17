<?php
// public/index.php
// Main entrypoint and router for the PHP MVC application

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Load the database connection
require_once '../includes/db_connect.php';

// 2. Load MVC Controllers globally to allow static type inspections
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/MenuController.php';
require_once '../app/controllers/ReservationController.php';
require_once '../app/controllers/AdminController.php';

// 3. Determine routing URL from the query string (e.g. ?url=menu)
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';

// 4. MVC Routing switchboard
switch ($url) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'menu':
        $controller = new MenuController($pdo);
        $controller->index();
        break;

    case 'reservation/process':
        $controller = new ReservationController($pdo);
        $controller->process();
        break;

    case 'admin':
    case 'admin/dashboard':
        $controller = new AdminController($pdo);
        $controller->dashboard();
        break;

    case 'admin/login':
        $controller = new AdminController($pdo);
        $controller->login();
        break;

    case 'admin/users':
        $controller = new AdminController($pdo);
        $controller->users();
        break;

    case 'admin/reservations':
        $controller = new AdminController($pdo);
        $controller->reservations();
        break;

    case 'admin/inventory':
        $controller = new AdminController($pdo);
        $controller->inventory();
        break;

    case 'admin/reports':
        $controller = new AdminController($pdo);
        $controller->reports();
        break;

    case 'setup-db':
        require_once '../config/setup_db.php';
        break;

    case 'gioi-thieu':
    case 'combo':
    case 'album':
    case 'tin-tuc':
    case 'lien-he':
        // Load custom MVC pages using static fallback templates or rendering home layout
        require_once '../app/views/layouts/header.php';
        
        // Define clean custom titles and placeholders based on the route
        $titleMap = [
            'gioi-thieu' => ['Đôi Nét Về Chúng Tôi', 'Hương Việt Quán chuyên phục vụ ẩm thực Việt trọn vị.'],
            'combo' => ['Bàn Tiệc - Combo Đặc Sắc', 'Các set menu trọn gói dành cho tiệc cưới hỏi, sinh nhật, liên hoan.'],
            'album' => ['Thư Viện Ảnh Nhà Hàng', 'Khoảnh khắc sum vầy ấm cúng và các món ăn đặc sắc.'],
            'tin-tuc' => ['Tin Tức & Sự Kiện Nổi Bật', 'Cập nhật tin tức ẩm thực, sự kiện và chương trình khuyến mãi.'],
            'lien-he' => ['Liên Hệ Với Chúng Tôi', 'Mọi thắc mắc và đóng góp ý kiến, xin vui lòng gửi về cho quán.']
        ];
        
        $currentInfo = isset($titleMap[$url]) ? $titleMap[$url] : ['Hương Việt Bến Cát', 'Đậm đà hương vị truyền thống.'];
        ?>
        <main class="subpage-wrapper" style="padding: 60px 0; background-color: #faf7f2; min-height: 500px;">
            <div class="wrap-content">
                <div class="tieude1" style="text-align: center; margin-bottom: 40px;">
                    <span class="name_cty">Ẩm Thực Hương Việt</span>
                    <h2><?= htmlspecialchars($currentInfo[0]) ?></h2>
                    <p style="color: #777; margin-top: 10px;"><?= htmlspecialchars($currentInfo[1]) ?></p>
                </div>
                
                <div class="content-box" style="background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); line-height: 1.8;">
                    <?php if ($url === 'gioi-thieu'): ?>
                        <p><strong>Ẩm Thực Hương Việt Bến Cát</strong> tự hào là một trong những nhà hàng sân vườn hàng đầu tại Bình Dương, chuyên phục vụ các món ăn gia đình Việt Nam truyền thống đậm vị quê hương.</p>
                        <p>Được thành lập với sứ mệnh mang đến không gian ẩm thực thân thiện, ấm cúng và đầy hương vị bản xứ, Hương Việt luôn cam kết lựa chọn nguyên liệu tươi sống sạch nhất từ thiên nhiên như gà tre thả đồi, cá lóc đồng tự nhiên, khô cá dứa từ Vũng Tàu...</p>
                        <p>Hãy đến với chúng tôi để cảm nhận trọn vẹn tình quê hương dạt dào trong từng thớ thịt cá lóc rút xương nhồi thịt nướng vàng óng ả!</p>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:30px;">
                            <img src="https://amthuchuongviet.com.vn/thumbs/400x400x1/upload/photo/z3742241322030f2009ce33d27dc515d291a1416f8f3d7-79570-89710.jpg" style="width:100%; border-radius:8px;" alt="Không gian 1">
                            <img src="https://amthuchuongviet.com.vn/thumbs/400x400x1/upload/photo/z374224123281814cbc4216fe3f2ad5c81be314261e465-10910-79320.jpg" style="width:100%; border-radius:8px;" alt="Món ngon 2">
                        </div>
                    <?php elseif ($url === 'combo'): ?>
                        <p>Hệ thống bàn tiệc & combo được thiết kế phù hợp cho các nhóm khách từ nhỏ tới lớn, tiết kiệm chi phí lên đến 20%:</p>
                        <ul style="margin-left: 20px; list-style-type: square; display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
                            <li><strong>Combo Gia Đình Ấm Cúng (2-4 khách)</strong>: Cá lóc rút xương nhồi thịt cuốn bánh tráng + Gỏi tai heo hoa chuối + Lẩu cua đồng chỉ với 450.000đ.</li>
                            <li><strong>Combo Tiệc Sum Vầy (6-8 khách)</strong>: Gà tre hấp mắm nhĩ + Khô cá dứa bóp xoài + Nghêu hấp sả + Lẩu cá tầm nướng chỉ với 980.000đ.</li>
                            <li><strong>Bàn Tiệc Hội Nghị Liên Hoan (10-12 khách)</strong>: Vịt trời 3 món + Đậu hũ chiên giòn + Khai vị khoai tây + Lẩu hải sản đặc biệt chỉ từ 1.850.000đ.</li>
                        </ul>
                    <?php elseif ($url === 'album'): ?>
                        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:20px;">
                            <img src="https://amthuchuongviet.com.vn/thumbs/700x660x1/upload/photo/bn1-1906-4010.png" style="width:100%; border-radius:8px; height:200px; object-fit:cover;" alt="Hình ảnh">
                            <img src="https://amthuchuongviet.com.vn/thumbs/400x400x1/upload/photo/z3742241322030f2009ce33d27dc515d291a1416f8f3d7-79570-89710.jpg" style="width:100%; border-radius:8px; height:200px; object-fit:cover;" alt="Hình ảnh">
                            <img src="https://amthuchuongviet.com.vn/thumbs/400x400x1/upload/photo/z374224123281814cbc4216fe3f2ad5c81be314261e465-10910-79320.jpg" style="width:100%; border-radius:8px; height:200px; object-fit:cover;" alt="Hình ảnh">
                            <img src="https://amthuchuongviet.com.vn/thumbs/400x400x1/upload/photo/z374224134091561f934dbffc14e9c46b28d24f1828667-1-37680-54020.jpg" style="width:100%; border-radius:8px; height:200px; object-fit:cover;" alt="Hình ảnh">
                        </div>
                    <?php elseif ($url === 'tin-tuc'): ?>
                        <div style="display: flex; flex-direction: column; gap: 30px;">
                            <div style="display: flex; gap: 20px; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                                <img src="https://amthuchuongviet.com.vn/thumbs/1366x525x1/upload/photo/huongvietbanner2-21950.png" style="width:150px; height:100px; object-fit:cover; border-radius:6px;">
                                <div>
                                    <h4 style="font-size:18px; color:var(--primary); margin-bottom:5px;"><a href="#">Khuyến mãi ngày lễ lớn cực hấp dẫn khi đặt tiệc trước</a></h4>
                                    <p style="font-size:13px; color:#999;">Cập nhật ngày 17/05/2026</p>
                                    <p style="font-size:14px; color:#555;">Tặng ngay nước ngọt và giảm 10% tổng hóa đơn cho khách hàng đặt bàn trước 3 ngày...</p>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                                <img src="https://amthuchuongviet.com.vn/thumbs/1366x525x1/upload/photo/bannerhuongviet-97110.png" style="width:150px; height:100px; object-fit:cover; border-radius:6px;">
                                <div>
                                    <h4 style="font-size:18px; color:var(--primary); margin-bottom:5px;"><a href="#">Ưu Đãi Đón Giáng Sinh & Năm Mới 2026</a></h4>
                                    <p style="font-size:13px; color:#999;">Cập nhật ngày 17/05/2026</p>
                                    <p style="font-size:14px; color:#555;">Chương trình bốc thăm trúng thưởng đặc biệt dành riêng cho các hóa đơn trên 2.000.000đ...</p>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($url === 'lien-he'): ?>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                            <div>
                                <h4 style="font-size:18px; color:var(--primary); margin-bottom:15px;">Gửi thông tin phản hồi cho quán</h4>
                                <form style="display:flex; flex-direction:column; gap:15px;">
                                    <input type="text" placeholder="Họ và tên của bạn *" required style="padding:10px; border:1px solid #ccc; border-radius:4px;">
                                    <input type="email" placeholder="Email liên hệ" style="padding:10px; border:1px solid #ccc; border-radius:4px;">
                                    <input type="text" placeholder="Số điện thoại di động *" required style="padding:10px; border:1px solid #ccc; border-radius:4px;">
                                    <textarea placeholder="Nội dung ý kiến đóng góp hoặc phản hồi *" required rows="4" style="padding:10px; border:1px solid #ccc; border-radius:4px; resize:none;"></textarea>
                                    <button type="submit" class="btn-datban" style="align-self: flex-start; padding:10px 25px; border-radius:4px; border:none;">GỬI LIÊN HỆ</button>
                                </form>
                            </div>
                            <div>
                                <h4 style="font-size:18px; color:var(--primary); margin-bottom:15px;">Bản đồ chỉ dẫn Google Maps</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.2285199694297!2d106.61118671534062!3d11.096336356230537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d75d2757279f%3A0xebe6e0fa82260ff0!2zRMO5bmcgREogMTAsIEtEQyBN4bu5IFBoxrDhu5tjIDMsIFRow5tpIEjDsmEsIELhur9uIEPDoXQsIELDqG5oIETGsMahbmc!5e0!3m2!1svi!2s!4v1684334000000!5m2!1svi!2s" style="width:100%; height:300px; border:0; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);" allowfullscreen loading="lazy"></iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
        <?php
        require_once '../app/views/layouts/footer.php';
        break;

    default:
        // Render simple 404 page
        require_once '../app/views/layouts/header.php';
        echo '<main style="padding: 100px 0; text-align: center; background-color:#faf7f2;">
                <div class="wrap-content">
                    <h2 style="color:var(--accent); font-size:36px; margin-bottom:10px;">404 - KHÔNG TÌM THẤY TRANG</h2>
                    <p style="color:#555;">Trang bạn yêu cầu hiện không tồn tại hoặc đã được di chuyển.</p>
                    <a href="?url=home" class="btn-datban" style="display:inline-block; margin-top:20px;">QUAY VỀ TRANG CHỦ</a>
                </div>
              </main>';
        require_once '../app/views/layouts/footer.php';
        break;
}