<?php
// app/controllers/HomeController.php

class HomeController
{
    public function index()
    {
        // Trong tương lai, nếu bạn muốn đưa các "Món ăn nổi bật" ra trang chủ,
        // Bạn sẽ gọi Model ở đây (Ví dụ: $featuredDishes = DishModel::getHotDishes();)
        // Sau đó truyền biến $featuredDishes sang View.

        // Gọi các thành phần Giao diện (View) để lắp ghép lại thành trang hoàn chỉnh
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/home/index.php';
        require_once '../app/views/layouts/footer.php';
    }
}
