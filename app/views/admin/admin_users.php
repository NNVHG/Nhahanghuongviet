<?php
// app/views/admin/admin_users.php
// Clean, beautiful view for staff personnel management

/** @var array $users */
$users = $users ?? [];
?>

<main class="admin-page" style="padding: 60px 0; background-color: #faf7f2; min-height: 600px;">
    <div class="wrap-content">
        
        <!-- Header Actions -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h2 style="font-family: var(--font-heading); color: var(--primary); font-size: 28px;">Quản Lý Nhân Sự & Người Dùng</h2>
                <p style="color: #666; margin-top:5px;">Quản trị tài khoản đăng nhập của Giám đốc, Kế toán, Trưởng bếp, và Thu ngân.</p>
            </div>
            <a href="?url=admin/dashboard" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; background: var(--dark); border-color: var(--dark); font-size: 13.5px;"><i class="fas fa-arrow-left"></i> Về Dashboard</a>
        </div>

        <?php if (isset($alert)): ?>
            <div style="background: <?= $alert[0] === 'success' ? '#f0fdf4' : '#fdf2f2' ?>; color: <?= $alert[0] === 'success' ? '#16a34a' : '#ec5b5b' ?>; padding: 15px; border-radius: 6px; font-size: 14.5px; margin-bottom: 25px; border-left: 4px solid <?= $alert[0] === 'success' ? '#16a34a' : '#ec5b5b' ?>;">
                <?= htmlspecialchars($alert[1]) ?>
            </div>
        <?php endif; ?>

        <!-- Create new user form -->
        <div style="background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); margin-bottom: 30px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 15px; text-transform: uppercase;">Thêm Thành Viên Nhân Sự Mới</h3>
            
            <form method="POST" action="?url=admin/users" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) auto; gap: 15px; align-items: flex-end;">
                <div>
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Họ và Tên *</label>
                    <input type="text" name="full_name" required placeholder="Ví dụ: Nguyễn Văn A..." style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <div>
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Tài khoản đăng nhập *</label>
                    <input type="text" name="username" required placeholder="Tên đăng nhập viết liền..." style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <div>
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Mật khẩu *</label>
                    <input type="password" name="password" required placeholder="Mật khẩu bảo mật..." style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;">
                </div>
                <div>
                    <label style="font-size: 13px; color:#555; font-weight:bold; margin-bottom:5px; display:block;">Chức vụ phân quyền *</label>
                    <select name="role" required style="width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px; background:#fff;">
                        <option value="GiamDoc">Giám đốc</option>
                        <option value="TruongPhongKeToan">Trưởng phòng kế toán</option>
                        <option value="TruongPhongAmThuc">Trưởng phòng ẩm thực</option>
                        <option value="ThuNgan">Thu ngân</option>
                        <option value="PhucVu">Phục vụ</option>
                        <option value="LaoCong">Lao công</option>
                    </select>
                </div>
                <button type="submit" name="add_user" class="btn-datban" style="padding: 10px 25px; border-radius: 4px; height:41px; background:var(--secondary); border-color:var(--secondary);">THÊM NHÂN SỰ</button>
            </form>
        </div>

        <!-- Users list table -->
        <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; padding: 25px;">
            <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 18px; margin-bottom: 15px; text-transform: uppercase;">Danh Sách Tài Khoản Nhân Sự</h3>
            
            <table border="0" width="100%" cellpadding="12" style="border-collapse: collapse; text-align: left; font-size:14.5px;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee; font-family: var(--font-heading); color: var(--primary);">
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Tên Đăng Nhập</th>
                        <th>Chức Vụ</th>
                        <th>Ngày Đăng Ký</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr style="border-bottom: 1px solid #f6f6f6;" onmouseover="this.style.backgroundColor='#fdfdfd'" onmouseout="this.style.backgroundColor='transparent'">
                            <td>#<?= $user['id'] ?></td>
                            <td style="font-weight:bold; color:var(--dark);"><?= htmlspecialchars($user['full_name']) ?></td>
                            <td><code style="background:#f3f4f6; padding:3px 6px; border-radius:4px; font-size:13.5px;"><?= htmlspecialchars($user['username']) ?></code></td>
                            <td>
                                <?php
                                $roleColors = [
                                    'GiamDoc' => ['#fef3c7', '#d97706', 'Giám Đốc'],
                                    'TruongPhongKeToan' => ['#eff6ff', '#2563eb', 'Kế Toán Trưởng'],
                                    'TruongPhongAmThuc' => ['#f0fdf4', '#16a34a', 'Trưởng Bếp'],
                                    'ThuNgan' => ['#faf0fd', '#8e14b8', 'Thu Ngân'],
                                    'PhucVu' => ['#f3f4f6', '#4b5563', 'Phục Vụ'],
                                    'LaoCong' => ['#fef2f2', '#dc2626', 'Lao Công']
                                ];
                                $curRole = $roleColors[$user['role']] ?? ['#eee', '#333', $user['role']];
                                ?>
                                <span style="padding:4px 10px; background:<?= $curRole[0] ?>; color:<?= $curRole[1] ?>; border-radius:12px; font-size:12px; font-weight:bold;">
                                    <?= $curRole[2] ?>
                                </span>
                            </td>
                            <td style="color:#666;"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>