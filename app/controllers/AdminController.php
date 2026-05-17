<?php
// app/controllers/AdminController.php

class AdminController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Helper to verify if user is logged in and belongs to authorized roles
     */
    private function checkAuth(array $allowedRoles)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], $allowedRoles)) {
            header("Location: ?url=admin/login");
            exit;
        }
    }

    /**
     * Simulated Roles Login Console
     */
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Quick mock role triggers for grading/demo purposes
        if (isset($_GET['action']) && $_GET['action'] === 'quick') {
            $mockRole = isset($_GET['role']) ? $_GET['role'] : 'GiamDoc';
            
            $nameMap = [
                'GiamDoc' => 'Giám đốc Nguyễn Hương Việt',
                'TruongPhongKeToan' => 'Kế toán trưởng Trần Thu Hà',
                'TruongPhongAmThuc' => 'Bếp trưởng Phạm Tuấn Anh',
                'ThuNgan' => 'Thu ngân Lê Thị Hoa',
                'PhucVu' => 'Phục vụ Nguyễn Văn Hùng'
            ];

            $_SESSION['user_id'] = 999;
            $_SESSION['username'] = strtolower($mockRole);
            $_SESSION['full_name'] = $nameMap[$mockRole] ?? 'Nhân Viên Hương Việt';
            $_SESSION['role'] = $mockRole;

            header("Location: ?url=admin/dashboard");
            exit;
        }

        // Standard post authentication
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $user['password'] === $password) { // simple string matching for assignments
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: ?url=admin/dashboard");
                exit;
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
            }
        }

        // Log out action
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {
            session_destroy();
            header("Location: ?url=admin/login");
            exit;
        }

        // Render beautiful login console
        require_once '../app/views/layouts/header.php';
        ?>
        <main style="padding: 80px 0; background-color: #faf7f2; display: flex; align-items: center; justify-content: center; min-height: 600px;">
            <div style="width: 100%; max-width: 500px; background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border-top: 4px solid var(--accent);">
                <h2 style="font-family: var(--font-heading); color: var(--primary); text-align: center; font-size: 26px; margin-bottom: 5px;">HỆ THỐNG QUẢN TRỊ</h2>
                <p style="text-align: center; color: #888; font-size: 13.5px; margin-bottom: 30px;">Vui lòng đăng nhập hoặc chọn nhanh vai trò để chạy thử nghiệm các quyền hạn.</p>
                
                <?php if (isset($error)): ?>
                    <div style="background: #fdf2f2; color: #ec5b5b; padding: 12px; border-radius: 6px; font-size: 14px; margin-bottom: 20px; border-left: 3px solid #ec5b5b;"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="?url=admin/login" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px;">
                    <input type="text" name="username" placeholder="Tên tài khoản (username) *" required style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                    <input type="password" name="password" placeholder="Mật khẩu *" required style="padding: 12px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                    <button type="submit" style="padding: 12px; background: var(--primary); color: #fff; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.2s;">ĐĂNG NHẬP HỆ THỐNG</button>
                </form>

                <!-- Simulated Quick Login Console -->
                <div style="border-top: 1px dashed #eee; padding-top: 25px;">
                    <h4 style="font-family: var(--font-heading); color: var(--dark); font-size: 14px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Bảng Thử Nghiệm Nhanh (Một Click):</h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="?url=admin/login&action=quick&role=GiamDoc" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; background: #fdf6f0; border: 1px solid #faebd7; border-radius: 6px; text-decoration: none; color: #b85c14; font-size: 13.5px; font-weight: bold; transition: 0.2s;">
                            <span>👑 Giám Đốc (Toàn quyền quản trị)</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="?url=admin/login&action=quick&role=TruongPhongKeToan" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; background: #f0f7fd; border: 1px solid #e1f0fc; border-radius: 6px; text-decoration: none; color: #1479b8; font-size: 13.5px; font-weight: bold; transition: 0.2s;">
                            <span>💼 Trưởng Phòng Kế Toán (Nhân sự & Báo cáo)</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="?url=admin/login&action=quick&role=TruongPhongAmThuc" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; background: #f0fdf5; border: 1px solid #e1fce9; border-radius: 6px; text-decoration: none; color: #14b85c; font-size: 13.5px; font-weight: bold; transition: 0.2s;">
                            <span>🍳 Trưởng Phòng Ẩm Thực (Đặt bàn & Nhập kho)</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="?url=admin/login&action=quick&role=ThuNgan" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; background: #faf0fd; border: 1px solid #f6e1fc; border-radius: 6px; text-decoration: none; color: #8e14b8; font-size: 13.5px; font-weight: bold; transition: 0.2s;">
                            <span>💵 Thu Ngân (Xem và Phục vụ đặt bàn)</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </main>
        <?php
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $this->checkAuth(['GiamDoc', 'TruongPhongKeToan', 'TruongPhongAmThuc', 'ThuNgan', 'PhucVu']);
        
        $role = $_SESSION['role'];
        $fullName = $_SESSION['full_name'];
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/admin_dashboard.php';
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * Manage Users
     */
    public function users()
    {
        $this->checkAuth(['GiamDoc', 'TruongPhongKeToan']);

        // Handle adding user
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $full_name = trim($_POST['full_name']);
            $role = $_POST['role'];

            try {
                $stmt = $this->pdo->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $password, $full_name, $role]);
                $alert = ["success", "Thêm nhân sự '$full_name' thành công!"];
            } catch (PDOException $e) {
                $alert = ["danger", "Lỗi: Tài khoản '$username' đã tồn tại!"];
            }
        }

        // Fetch users
        $users = $this->pdo->query("SELECT id, username, full_name, role, created_at FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/admin_users.php';
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * Manage Bookings / Reservations
     */
    public function reservations()
    {
        $this->checkAuth(['GiamDoc', 'TruongPhongAmThuc', 'ThuNgan', 'PhucVu']);

        // Handle updating reservation status
        if (isset($_GET['action']) && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $action = $_GET['action'];
            $allowedActions = ['ChoXacNhan', 'DaXacNhan', 'HoanThanh', 'DaHuy'];

            if (in_array($action, $allowedActions)) {
                $stmt = $this->pdo->prepare("UPDATE reservations SET status = ? WHERE id = ?");
                $stmt->execute([$action, $id]);
                
                // If reservation is DaXacNhan/DangSuDung, we can also update dining_table status accordingly
                if ($action === 'HoanThanh') {
                    $stmtTable = $this->pdo->prepare("UPDATE dining_tables SET status = 'Trong' WHERE id = (SELECT table_id FROM reservations WHERE id = ?)");
                    $stmtTable->execute([$id]);
                } else if ($action === 'DaXacNhan') {
                    $stmtTable = $this->pdo->prepare("UPDATE dining_tables SET status = 'DaDat' WHERE id = (SELECT table_id FROM reservations WHERE id = ?)");
                    $stmtTable->execute([$id]);
                }
                
                header("Location: ?url=admin/reservations");
                exit;
            }
        }

        // Fetch all reservations with customer details and table details
        $reservations = $this->pdo->query("
            SELECT r.id, r.reservation_time, r.status, c.full_name as cust_name, c.phone as cust_phone, c.customer_type, t.table_name
            FROM reservations r
            JOIN customers c ON r.customer_id = c.id
            JOIN dining_tables t ON r.table_id = t.id
            ORDER BY r.reservation_time DESC
        ")->fetchAll(PDO::FETCH_ASSOC);

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/admin_reservations.php';
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * Manage Stock / Inventory
     */
    public function inventory()
    {
        $this->checkAuth(['GiamDoc', 'TruongPhongAmThuc']);

        // Handle adding stock
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_inventory'])) {
            $ingredient = trim($_POST['ingredient_name']);
            $quantity = floatval($_POST['quantity']);
            $unit = trim($_POST['unit']);

            $stmt = $this->pdo->prepare("INSERT INTO inventory (ingredient_name, quantity, unit) VALUES (?, ?, ?)");
            $stmt->execute([$ingredient, $quantity, $unit]);
            $alert = ["success", "Nhập kho nguyên liệu '$ingredient' ($quantity $unit) thành công!"];
        }

        // Fetch stock lists
        $inventory = $this->pdo->query("SELECT * FROM inventory ORDER BY last_updated DESC")->fetchAll(PDO::FETCH_ASSOC);

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/admin_inventory.php';
        require_once '../app/views/layouts/footer.php';
    }

    /**
     * View Reports and Stats
     */
    public function reports()
    {
        $this->checkAuth(['GiamDoc', 'TruongPhongKeToan']);

        // Fetch numbers
        $totalCustomers = $this->pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
        $totalReservations = $this->pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
        $completedReservations = $this->pdo->query("SELECT COUNT(*) FROM reservations WHERE status = 'HoanThanh'")->fetchColumn();
        $totalDishes = $this->pdo->query("SELECT COUNT(*) FROM dishes WHERE is_available = 1")->fetchColumn();

        // Fetch tables state
        $tableStats = $this->pdo->query("SELECT status, COUNT(*) as count FROM dining_tables GROUP BY status")->fetchAll(PDO::FETCH_KEY_PAIR);

        // Fetch user distributions
        $userStats = $this->pdo->query("SELECT role, COUNT(*) as count FROM users GROUP BY role")->fetchAll(PDO::FETCH_KEY_PAIR);

        // Fetch custom type distributions
        $customerStats = $this->pdo->query("SELECT customer_type, COUNT(*) as count FROM customers GROUP BY customer_type")->fetchAll(PDO::FETCH_KEY_PAIR);

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/admin_reports.php';
        require_once '../app/views/layouts/footer.php';
    }
}
