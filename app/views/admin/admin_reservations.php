<?php
// app/views/admin/admin_reservations.php
// Highly aesthetic presentation view for customer bookings
?>

<main style="padding: 60px 0; background-color: #faf7f2; min-height: 600px;">
    <div class="wrap-content">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h2 style="font-family: var(--font-heading); color: var(--primary); font-size: 28px;">Quản Lý Yêu Cầu Đặt Bàn</h2>
                <p style="color: #666; margin-top:5px;">Xem trạng thái đặt bàn, thông tin khách hàng và phân bố bàn tiệc của khách.</p>
            </div>
            <a href="?url=admin/dashboard" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; background: var(--dark); border-color: var(--dark); font-size: 13.5px;"><i class="fas fa-arrow-left"></i> Về Dashboard</a>
        </div>

        <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; padding: 25px;">
            <table border="0" width="100%" cellpadding="12" style="border-collapse: collapse; text-align: left; font-size:14.5px;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee; font-family: var(--font-heading); color: var(--primary);">
                        <th>Thời Gian</th>
                        <th>Khách Hàng</th>
                        <th>Phân Loại Khách</th>
                        <th>Bàn Chỉ Định</th>
                        <th>Trạng Thái</th>
                        <th style="text-align:right;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($reservations) === 0): ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 30px; color:#999;">Chưa có yêu cầu đặt bàn nào được ghi nhận.</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($reservations as $r): ?>
                        <tr style="border-bottom: 1px solid #f6f6f6; transition: 0.2s;" onmouseover="this.style.backgroundColor='#fdfdfd'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="font-weight:bold; color:var(--dark);"><?= date("H:i - d/m/Y", strtotime($r['reservation_time'])) ?></td>
                            <td>
                                <strong><?= htmlspecialchars($r['cust_name']) ?></strong><br>
                                <span style="color:#777; font-size:13px;"><i class="fas fa-phone" style="font-size:10px; margin-right:3px;"></i> <?= htmlspecialchars($r['cust_phone']) ?></span>
                            </td>
                            <td>
                                <?php if ($r['customer_type'] === 'VIP'): ?>
                                    <span style="padding:4px 8px; background:#fef3c7; color:#d97706; border-radius:12px; font-size:12px; font-weight:bold;"><i class="fas fa-crown"></i> VIP</span>
                                <?php elseif ($r['customer_type'] === 'KhachQuen'): ?>
                                    <span style="padding:4px 8px; background:#ecfdf5; color:#059669; border-radius:12px; font-size:12px; font-weight:bold;"><i class="fas fa-thumbs-up"></i> Khách Quen</span>
                                <?php else: ?>
                                    <span style="padding:4px 8px; background:#f3f4f6; color:#4b5563; border-radius:12px; font-size:12px;"><i class="fas fa-user"></i> Vãng Lai</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= htmlspecialchars($r['table_name']) ?></strong></td>
                            <td>
                                <?php if ($r['status'] === 'ChoXacNhan'): ?>
                                    <span style="padding:4px 10px; background:#fff7ed; color:#ea580c; border-radius:4px; font-size:12px; font-weight:bold;">Chờ Xác Nhận</span>
                                <?php elseif ($r['status'] === 'DaXacNhan'): ?>
                                    <span style="padding:4px 10px; background:#eff6ff; color:#2563eb; border-radius:4px; font-size:12px; font-weight:bold;">Đã Xác Nhận</span>
                                <?php elseif ($r['status'] === 'HoanThanh'): ?>
                                    <span style="padding:4px 10px; background:#f0fdf4; color:#16a34a; border-radius:4px; font-size:12px; font-weight:bold;">Hoàn Thành</span>
                                <?php else: ?>
                                    <span style="padding:4px 10px; background:#fef2f2; color:#dc2626; border-radius:4px; font-size:12px;">Đã Hủy</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:right; display:flex; gap:6px; justify-content:flex-end;">
                                <?php if ($r['status'] === 'ChoXacNhan'): ?>
                                    <a href="?url=admin/reservations&action=DaXacNhan&id=<?= $r['id'] ?>" class="btn-datban" style="padding: 5px 10px; border-radius: 4px; font-size: 11px; background:#2563eb; border-color:#2563eb;">Xác Nhận</a>
                                <?php endif; ?>
                                
                                <?php if ($r['status'] === 'DaXacNhan'): ?>
                                    <a href="?url=admin/reservations&action=HoanThanh&id=<?= $r['id'] ?>" class="btn-datban" style="padding: 5px 10px; border-radius: 4px; font-size: 11px; background:#16a34a; border-color:#16a34a;">Hoàn Thành</a>
                                <?php endif; ?>

                                <?php if ($r['status'] !== 'HoanThanh' && $r['status'] !== 'DaHuy'): ?>
                                    <a href="?url=admin/reservations&action=DaHuy&id=<?= $r['id'] ?>" class="btn-datban" style="padding: 5px 10px; border-radius: 4px; font-size: 11px; background:#dc2626; border-color:#dc2626;" onclick="return confirm('Bạn có chắc muốn hủy đặt bàn này không?')">Hủy</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>