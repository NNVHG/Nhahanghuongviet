<?php
// app/models/Dish.php

class Dish
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Lấy toàn bộ danh mục kèm theo danh sách món ăn thuộc danh mục đó
    public function getFullMenu()
    {
        $menuData = [];

        try {
            // 1. Lấy danh sách các danh mục (Categories)
            $stmtCats = $this->pdo->query("SELECT * FROM categories ORDER BY id ASC");
            $categories = $stmtCats->fetchAll(PDO::FETCH_ASSOC);

            // 2. Lặp qua từng danh mục để lấy món ăn tương ứng
            foreach ($categories as $cat) {
                $stmtDishes = $this->pdo->prepare("SELECT * FROM dishes WHERE category_id = ? AND is_available = 1");
                $stmtDishes->execute([$cat['id']]);
                $dishes = $stmtDishes->fetchAll(PDO::FETCH_ASSOC);

                // Chỉ thêm vào menu những danh mục có chứa ít nhất 1 món ăn
                if (count($dishes) > 0) {
                    $menuData[] = [
                        'category_id' => $cat['id'],
                        'category_name' => $cat['name'],
                        'dishes' => $dishes
                    ];
                }
            }
            return $menuData;
        } catch (PDOException $e) {
            // Ghi log lỗi nếu cần thiết trong môi trường thực tế
            return [];
        }
    }
}
