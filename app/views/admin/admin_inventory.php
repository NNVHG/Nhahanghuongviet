<?php
// app/views/admin/admin_inventory.php
// Highly aesthetic presentation view for stock inventory management

/** @var array $inventory */
$inventory = $inventory ?? [];
?>

<main style="padding: 60px 0; background-color: #faf7f2; min-height: 600px;">
    <div class="wrap-content">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h2 style="font-family: var(--font-heading); color: var(--primary); font-size: 28px;">Quản Lý Kho Hàng & Nguyên Liệu</h2>
                <p style="color: #666; margin-top:5px;">Xem tồn kho thực phẩm, gia vị phục vụ chế biến món ăn và nhập kho nguyên liệu mới.</p>
            </div>
            <a href="?url=admin/dashboard" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; background: var(--dark); border-color: var(--dark); font-size: 13.5px;"><i class="fas fa-arrow-left"></i> Về Dashboard</a>
        </div>

        <?php if (isset($alert)): ?>
            <div style="background: #f0fdf4; color: #16a34a; padding: 15px; border-radius: 6px; font-size: 14.5px; margin-bottom: 25px; border-left: 4px solid #16a34a;">
                <?= $alert[1] ?>
            </div>
        <?php endif; ?>

        <!-- Form to Add Inventory -->
        <div style="background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); margin-bottom: 30px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 15px; text-transform: uppercase;">Nhập Kho Nguyên Liệu Mới</h3>
            <form method="POST" action="?url=admin/inventory" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 2; min-width: 200px;">
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Tên thực phẩm / nguyên liệu *</label>
                    <input type="text" name="ingredient_name" required placeholder="Ví dụ: Cá lóc đồng, Thịt ba rọi, Rau thơm..." style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <div style="flex: 1; min-width: 100px;">
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Số lượng nhập *</label>
                    <input type="number" step="0.01" name="quantity" required placeholder="0.00" style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <div style="flex: 1; min-width: 100px;">
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Đơn vị tính *</label>
                    <input type="text" name="unit" required placeholder="Kg, Lít, Bó..." style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <button type="submit" name="add_inventory" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; height:41px; background:var(--secondary); border-color:var(--secondary);">TIẾN HÀNH NHẬP</button>
            </form>
        </div>

        <!-- Stock List Table -->
        <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; padding: 25px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 15px; text-transform: uppercase;">Danh Sách Tồn Kho Hiện Tại</h3>
            <table border="0" width="100%" cellpadding="12" style="border-collapse: collapse; text-align: left; font-size:14.5px;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee; font-family: var(--font-heading); color: var(--primary);">
                        <th>ID</th>
                        <th>Tên Nguyên Liệu</th>
                        <th>Mức Tồn Kho</th>
                        <th>Đơn Vị Tính</th>
                        <th>Ngày Cập Nhật Mới Nhất</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($inventory) === 0): ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 30px; color:#999;">Kho hàng trống. Vui lòng nhập nguyên liệu thực phẩm.</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($inventory as $item): ?>
                        <tr style="border-bottom: 1px solid #f6f6f6;" onmouseover="this.style.backgroundColor='#fdfdfd'" onmouseout="this.style.backgroundColor='transparent'">
                            <td>#<?= $item['id'] ?></td>
                            <td style="font-weight:bold; color:var(--dark);"><?= htmlspecialchars($item['ingredient_name']) ?></td>
                            <td><strong style="color:var(--accent); font-size:16px;"><?= number_format($item['quantity'], 2) ?></strong></td>
                            <td><?= htmlspecialchars($item['unit']) ?></td>
                            <td style="color:#666;"><?= date('H:i:s - d/m/Y', strtotime($item['last_updated'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
