<main class="menu-page wrap-main w-clear" style="padding: 40px 0; background-color: #fcfcfc;">
    <div class="wap_1200 chung_tc">

        <div class="tieude1" style="text-align: center; margin-bottom: 40px;">
            <span class="name_cty">Khám Phá Ẩm Thực</span>
            <h2 style="color: #d35400; font-size: 32px; text-transform: uppercase;">Thực Đơn Nhà Hàng</h2>
        </div>

        <?php if (!empty($menuData)): ?>
            <?php foreach ($menuData as $category): ?>
                <div class="menu-category-block" style="margin-bottom: 50px;">
                    <h3 style="color: #27ae60; border-bottom: 2px solid #27ae60; padding-bottom: 10px; font-size: 24px; text-transform: uppercase;">
                        <i class="fas fa-utensils"></i> <?= htmlspecialchars($category['category_name']) ?>
                    </h3>

                    <div class="grid-products" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; margin-top: 20px;">

                        <?php foreach ($category['dishes'] as $dish): ?>
                            <div class="box-product text-decoration-none animate__animated animate__fadeInUp" style="background: #fff; border: 1px solid #ebebeb; border-radius: 8px; overflow: hidden; box-shadow: 0 3px 10px rgba(0,0,0,0.05); transition: transform 0.3s;">

                                <div class="pic-product zoom_hinh">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/noimage.png" onerror="this.src='assets/images/noimage.png'" alt="<?= htmlspecialchars($dish['name']) ?>" style="width: 100%; height: 220px; object-fit: cover;">
                                    </a>
                                </div>

                                <div class="info-product" style="padding: 15px; text-align: center;">
                                    <h3 class="name-product text-split" style="font-size: 18px; margin-bottom: 10px; height: 45px; overflow: hidden;">
                                        <?= htmlspecialchars($dish['name']) ?>
                                    </h3>

                                    <p class="price-product" style="color: #e74c3c; font-weight: bold; font-size: 18px; margin-bottom: 15px;">
                                        <?= number_format($dish['price'], 0, ',', '.') ?> <span>VNĐ</span>
                                    </p>

                                    <button onclick="openBookingModal()" style="padding: 8px 20px; background-color: #d35400; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s;">
                                        Đặt Bàn Ngay
                                    </button>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <p>Thực đơn đang được nhà hàng cập nhật. Vui lòng quay lại sau!</p>
            </div>
        <?php endif; ?>

    </div>
</main>