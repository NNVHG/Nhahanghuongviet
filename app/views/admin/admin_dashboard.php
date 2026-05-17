<?php
// app/views/admin/admin_dashboard.php
// Highly aesthetic admin dashboard panel matching active user roles

/** @var string $fullName */
$fullName = $fullName ?? 'Quản trị viên';

/** @var string $role */
$role = $role ?? 'GiamDoc';
?>

<main class="admin-dashboard" style="padding: 60px 0; background-color: #faf7f2; min-height: 550px;">
    <div class="wrap-content">
        
        <!-- Welcome Banner -->
        <div style="background: linear-gradient(135deg, var(--primary), var(--dark)); color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 40px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <div>
                <h1 style="font-family: var(--font-heading); font-size: 30px; margin-bottom: 5px;">Hệ Thống Quản Trị Hương Việt</h1>
                <p style="font-size: 15px; opacity: 0.9;">Xin chào, <strong><?= htmlspecialchars($fullName) ?></strong>! Chúc bạn một ngày làm việc hiệu quả.</p>
            </div>
            <div style="display:flex; align-items:center; gap:15px;">
                <span style="background: rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); padding: 6px 16px; border-radius: 20px; font-size: 13.5px; font-weight: bold; letter-spacing: 0.5px;">
                    <i class="fas fa-id-badge" style="margin-right:6px;"></i> Chức vụ: <?= htmlspecialchars($role) ?>
                </span>
                <a href="?url=admin/login&action=logout" style="padding: 7px 18px; background: var(--accent); color:#fff; font-weight:bold; font-size:13px; text-decoration:none; border-radius:4px; transition: 0.2s;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>

        <!-- Role Action Cards Grid -->
        <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 20px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 2px solid #e2d2bc; padding-bottom: 8px;">Mô-đun Quản Lý Được Phép</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px;">

            <!-- 1. Booking module -->
            <?php if (in_array($role, ['GiamDoc', 'TruongPhongAmThuc', 'ThuNgan', 'PhucVu'])): ?>
                <div style="background:#ffffff; border-radius:10px; padding:30px; box-shadow:0 4px 15px rgba(0,0,0,0.03); border-top:4px solid #3498db; display:flex; flex-direction:column; justify-content:space-between; height:200px;">
                    <div>
                        <h4 style="font-family:var(--font-heading); color:var(--primary); font-size:18px; margin-bottom:8px;"><i class="fas fa-concierge-bell" style="color:#3498db; margin-right:8px;"></i> Quản Lý Đặt Bàn</h4>
                        <p style="font-size:13.5px; color:#666; line-height:1.5;">Duyệt yêu cầu đặt bàn của thực khách, sắp xếp bàn ăn sân vườn, phòng VIP.</p>
                    </div>
                    <a href="?url=admin/reservations" class="btn-datban" style="padding:8px; border-radius:4px; font-size:13px; text-align:center; background:#3498db; border-color:#3498db; font-weight:bold;">Vào Xử Lý Ngay</a>
                </div>
            <?php endif; ?>

            <!-- 2. Stock / Inventory module -->
            <?php if (in_array($role, ['GiamDoc', 'TruongPhongAmThuc'])): ?>
                <div style="background:#ffffff; border-radius:10px; padding:30px; box-shadow:0 4px 15px rgba(0,0,0,0.03); border-top:4px solid #e67e22; display:flex; flex-direction:column; justify-content:space-between; height:200px;">
                    <div>
                        <h4 style="font-family:var(--font-heading); color:var(--primary); font-size:18px; margin-bottom:8px;"><i class="fas fa-boxes" style="color:#e67e22; margin-right:8px;"></i> Quản Lý Nhập Kho</h4>
                        <p style="font-size:13.5px; color:#666; line-height:1.5;">Kiểm tra nguyên liệu tươi sống tồn kho và bổ sung định lượng thực phẩm chế biến.</p>
                    </div>
                    <a href="?url=admin/inventory" class="btn-datban" style="padding:8px; border-radius:4px; font-size:13px; text-align:center; background:#e67e22; border-color:#e67e22; font-weight:bold;">Vào Nhập Kho</a>
                </div>
            <?php endif; ?>

            <!-- 3. Personnel / Staff CRUD module -->
            <?php if (in_array($role, ['GiamDoc', 'TruongPhongKeToan'])): ?>
                <div style="background:#ffffff; border-radius:10px; padding:30px; box-shadow:0 4px 15px rgba(0,0,0,0.03); border-top:4px solid #9b59b6; display:flex; flex-direction:column; justify-content:space-between; height:200px;">
                    <div>
                        <h4 style="font-family:var(--font-heading); color:var(--primary); font-size:18px; margin-bottom:8px;"><i class="fas fa-users-cog" style="color:#9b59b6; margin-right:8px;"></i> Quản Lý Nhân Sự</h4>
                        <p style="font-size:13.5px; color:#666; line-height:1.5;">Thêm mới nhân viên thu ngân, phục vụ, quản lý tài khoản và phân quyền.</p>
                    </div>
                    <a href="?url=admin/users" class="btn-datban" style="padding:8px; border-radius:4px; font-size:13px; text-align:center; background:#9b59b6; border-color:#9b59b6; font-weight:bold;">Quản Lý Nhân Sự</a>
                </div>
            <?php endif; ?>

            <!-- 4. Reports & Stats module -->
            <?php if (in_array($role, ['GiamDoc', 'TruongPhongKeToan'])): ?>
                <div style="background:#ffffff; border-radius:10px; padding:30px; box-shadow:0 4px 15px rgba(0,0,0,0.03); border-top:4px solid #2ecc71; display:flex; flex-direction:column; justify-content:space-between; height:200px;">
                    <div>
                        <h4 style="font-family:var(--font-heading); color:var(--primary); font-size:18px; margin-bottom:8px;"><i class="fas fa-chart-line" style="color:#2ecc71; margin-right:8px;"></i> Báo Cáo Thống Kê</h4>
                        <p style="font-size:13.5px; color:#666; line-height:1.5;">Xem biểu đồ doanh số đặt bàn, tỷ lệ phân bố khách VIP và trạng thái bàn trống.</p>
                    </div>
                    <a href="?url=admin/reports" class="btn-datban" style="padding:8px; border-radius:4px; font-size:13px; text-align:center; background:#2ecc71; border-color:#2ecc71; font-weight:bold;">Xem Báo Cáo</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>