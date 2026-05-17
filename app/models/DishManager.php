<?php
// classes/DishManager.php
require_once 'includes/db_connect.php';

class DishManager
{
    /** @var PDO */
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Phương thức lấy tất cả danh mục kèm theo món ăn tương ứng
    public function getMenu()
    {
        $menu = [];

        // Lấy danh sách danh mục
        $stmtCats = $this->pdo->query("SELECT * FROM categories");
        $categories = $stmtCats->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $cat) {
            // Lấy các món ăn thuộc danh mục này và đang có sẵn (is_available = 1)
            $stmtDishes = $this->pdo->prepare("SELECT * FROM dishes WHERE category_id = ? AND is_available = 1");
            $stmtDishes->execute([$cat['id']]);
            $dishes = $stmtDishes->fetchAll(PDO::FETCH_ASSOC);

            $menu[] = [
                'category_name' => $cat['name'],
                'dishes' => $dishes
            ];
        }
        return $menu;
    }
}
