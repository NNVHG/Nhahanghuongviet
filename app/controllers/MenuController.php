<?php
// app/controllers/MenuController.php
require_once '../app/models/Dish.php';

class MenuController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        // Khởi tạo Model và lấy dữ liệu
        $dishModel = new Dish($this->pdo);
        $menuData = $dishModel->getFullMenu();

        // Nạp View và truyền ngầm định biến $menuData sang file index.php của menu
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/menu/index.php';
        require_once '../app/views/layouts/footer.php';
    }
}
