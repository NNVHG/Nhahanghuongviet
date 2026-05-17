<?php
// app/views/admin/admin_reports.php
// Highly stunning and visual reporting charts view

/** @var int $totalCustomers */
$totalCustomers = $totalCustomers ?? 0;

/** @var int $totalReservations */
$totalReservations = $totalReservations ?? 0;

/** @var int $completedReservations */
$completedReservations = $completedReservations ?? 0;

/** @var int $totalDishes */
$totalDishes = $totalDishes ?? 0;

/** @var array $tableStats */
$tableStats = $tableStats ?? [];

/** @var array $customerStats */
$customerStats = $customerStats ?? [];
?>

<main class="admin-page" style="padding: 60px 0; background-color: #faf7f2; min-height: 600px;">
    <div class="wrap-content">
        
        <!-- Header Actions -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h2 style="font-family: var(--font-heading); color: var(--primary); font-size: 28px;">Báo Cáo Thống Kê Tổng Quan</h2>
                <p style="color: #666; margin-top:5px;">Báo cáo số liệu đặt bàn, tình trạng sử dụng bàn ăn và kết cấu đối tượng khách hàng của quán ăn.</p>
            </div>
            <a href="?url=admin/dashboard" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; background: var(--dark); border-color: var(--dark); font-size: 13.5px;"><i class="fas fa-arrow-left"></i> Về Dashboard</a>
        </div>

        <!-- 4 Stat Metric Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">
            
            <div style="background: #3498db; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <span style="font-size:14px; text-transform:uppercase; font-weight:bold; opacity:0.85;">Khách Hàng Đăng Ký</span>
                    <i class="fas fa-user-friends" style="font-size:24px; opacity:0.7;"></i>
                </div>
                <p style="font-size: 32px; font-weight: bold; font-family: var(--font-alt);"><?= $totalCustomers ?></p>
            </div>

            <div style="background: #e67e22; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(230, 126, 34, 0.2);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <span style="font-size:14px; text-transform:uppercase; font-weight:bold; opacity:0.85;">Lượt Đặt Bàn</span>
                    <i class="fas fa-receipt" style="font-size:24px; opacity:0.7;"></i>
                </div>
                <p style="font-size: 32px; font-weight: bold; font-family: var(--font-alt);"><?= $totalReservations ?></p>
            </div>

            <div style="background: #2ecc71; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <span style="font-size:14px; text-transform:uppercase; font-weight:bold; opacity:0.85;">Đặt Bàn Hoàn Thành</span>
                    <i class="fas fa-calendar-check" style="font-size:24px; opacity:0.7;"></i>
                </div>
                <p style="font-size: 32px; font-weight: bold; font-family: var(--font-alt);"><?= $completedReservations ?></p>
            </div>

            <div style="background: #9b59b6; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(155, 89, 182, 0.2);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <span style="font-size:14px; text-transform:uppercase; font-weight:bold; opacity:0.85;">Món Ăn Đang Bán</span>
                    <i class="fas fa-utensils" style="font-size:24px; opacity:0.7;"></i>
                </div>
                <p style="font-size: 32px; font-weight: bold; font-family: var(--font-alt);"><?= $totalDishes ?></p>
            </div>

        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:30px; flex-wrap:wrap; margin-bottom:40px;">
            
            <!-- Dining Tables Status Chart -->
            <div style="background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 25px; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 10px;"><i class="fas fa-table" style="color:var(--accent); margin-right:8px;"></i> Trạng Thái Bàn Ăn Hiện Tại</h3>
                <div style="display:flex; flex-direction:column; gap:20px;">
                    
                    <?php
                    $tablesTotal = array_sum($tableStats);
                    $tablesTotal = $tablesTotal > 0 ? $tablesTotal : 1; // avoid division by 0
                    
                    $statusMapping = [
                        'Trong' => ['🟢 Bàn Trống', '#2ecc71'],
                        'DaDat' => ['🟡 Đã Đặt (Chờ khách)', '#f1c40f'],
                        'DangSuDung' => ['🔴 Đang Phục Vụ', '#e74c3c']
                    ];
                    
                    foreach ($statusMapping as $key => $info):
                        $val = $tableStats[$key] ?? 0;
                        $percent = round(($val / $tablesTotal) * 100);
                    ?>
                        <div>
                            <div style="display:flex; justify-content:space-between; font-size:14px; margin-bottom:6px; font-weight:bold;">
                                <span><?= $info[0] ?></span>
                                <span><?= $val ?> Bàn (<?= $percent ?>%)</span>
                            </div>
                            <div style="width:100%; height:12px; background:#f3f4f6; border-radius:6px; overflow:hidden;">
                                <div style="width:<?= $percent ?>%; height:100%; background:<?= $info[1] ?>; border-radius:6px;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Customers Distribution Chart -->
            <div style="background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 25px; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 10px;"><i class="fas fa-users" style="color:var(--secondary); margin-right:8px;"></i> Phân Loại Khách Hàng</h3>
                <div style="display:flex; flex-direction:column; gap:20px;">
                    
                    <?php
                    $custTotal = array_sum($customerStats);
                    $custTotal = $custTotal > 0 ? $custTotal : 1; // avoid division by 0
                    
                    $custMapping = [
                        'VIP' => ['👑 Khách Hàng VIP', '#d97706'],
                        'KhachQuen' => ['👍 Khách Hàng Quen', '#16a34a'],
                        'VangLai' => ['👤 Khách Hàng Vãng Lai', '#4b5563']
                    ];
                    
                    foreach ($custMapping as $key => $info):
                        $val = $customerStats[$key] ?? 0;
                        $percent = round(($val / $custTotal) * 100);
                    ?>
                        <div>
                            <div style="display:flex; justify-content:space-between; font-size:14px; margin-bottom:6px; font-weight:bold;">
                                <span><?= $info[0] ?></span>
                                <span><?= $val ?> người (<?= $percent ?>%)</span>
                            </div>
                            <div style="width:100%; height:12px; background:#f3f4f6; border-radius:6px; overflow:hidden;">
                                <div style="width:<?= $percent ?>%; height:100%; background:<?= $info[1] ?>; border-radius:6px;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

    </div>
</main>