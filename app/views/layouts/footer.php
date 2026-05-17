    <!-- Footer -->
    <footer class="main-footer">
        <div class="wrap-content">
            <div class="footer-grid">
                
                <!-- Contact Info Col -->
                <div class="footer-col">
                    <h3>Ẩm Thực Hương Việt</h3>
                    <ul class="footer-contact-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Đường DJ 10, KDC Mỹ Phước 3, P. Thới Hòa, TP. Bến Cát, Tỉnh Bình Dương</p>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <p>Hotline: 0988.659.291</p>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <p>Email: quananhuongviet123@gmail.com</p>
                        </li>
                        <li>
                            <i class="fas fa-globe"></i>
                            <p>Website: amthuchuongviet.com.vn</p>
                        </li>
                    </ul>
                </div>

                <!-- Video Intro Col -->
                <div class="footer-col">
                    <h3>Giới thiệu Video</h3>
                    <div class="video-wrapper">
                        <!-- Premium food introduction embed -->
                        <iframe src="https://www.youtube.com/embed/HmsI7aMhLVE" title="Culinary Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>

                <!-- Google Map Col -->
                <div class="footer-col">
                    <h3>Bản Đồ Chỉ Đường</h3>
                    <div class="map-wrapper">
                        <!-- Google Maps centered on KDC Mỹ Phước 3 Bến Cát -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.2285199694297!2d106.61118671534062!3d11.096336356230537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d75d2757279f%3A0xebe6e0fa82260ff0!2zRMO5bmcgREogMTAsIEtEQyBN4bu5IFBoxrDhu5tjIDMsIFRow5tpIEjDsmEsIELhur9uIEPDoXQsIELDqG5oIETGsMahbmc!5e0!3m2!1svi!2s!4v1684334000000!5m2!1svi!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>

        <div class="copyright">
            <div class="wrap-content">
                <p>Bản Quyền &copy; <?php echo date("Y"); ?> <strong>QUÁN ĂN GIA ĐÌNH HƯƠNG VIỆT</strong>. Bảo lưu mọi quyền.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Social Contacts Widget (Like original site) -->
    <div class="floating-social">
        <!-- Zalo -->
        <a href="https://zalo.me/0988659291" target="_blank" class="social-icon zalo" title="Chat Zalo">
            <img src="https://amthuchuongviet.com.vn/assets/images/zl.png" alt="Zalo">
        </a>
        <!-- ShopeeFood -->
        <a href="https://shopeefood.vn/u/64GMb6h" target="_blank" class="social-icon shopee" title="Đặt trên ShopeeFood">
            <img src="https://amthuchuongviet.com.vn/thumbs/50x50x1/upload/photo/shopee-40370.jpg" alt="ShopeeFood">
        </a>
        <!-- GrabFood -->
        <a href="https://food.grab.com/vn/vi/restaurant/qu%C3%A1n-%C4%83n-gia-%C4%91%C3%ACnh-h%C6%B0%C6%A1ng-vi%E1%BB%B7t-c%C3%A1-l%C3%Bóc-r%C3%BAt-x%C6%B0%C6%A1ng-delivery/5-C3VJPFTDLX4FN6" target="_blank" class="social-icon grab" title="Đặt trên GrabFood">
            <img src="https://amthuchuongviet.com.vn/thumbs/50x50x1/upload/photo/grab-91540.jpg" alt="GrabFood" onerror="this.src='https://amthuchuongviet.com.vn/assets/images/noimage.png'">
        </a>
        <!-- HotLine Phone -->
        <a href="tel:0988659291" class="social-icon phone" title="Gọi Điện Thoại">
            <i class="fas fa-phone-alt"></i>
        </a>
    </div>

    <!-- Booking Modal (Triggered by Booking Buttons) -->
    <div id="modalBooking" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 100000; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
        <div style="background-color: #ffffff; border-radius: 12px; width: 90%; max-width: 450px; padding: 30px; box-shadow: var(--shadow-lg); position: relative; border-top: 4px solid var(--primary);">
            <span onclick="closeBookingModal()" style="position: absolute; top: 15px; right: 20px; font-size: 28px; cursor: pointer; color: var(--accent); font-weight: bold;">&times;</span>
            <h3 style="font-family: var(--font-heading); color: var(--primary); font-size: 24px; margin-bottom: 5px; text-transform: uppercase; text-align: center;">Đặt Bàn Nhanh</h3>
            <p style="text-align: center; font-size: 13.5px; color: #666; margin-bottom: 20px;">Vui lòng điền thông tin để chúng tôi chuẩn bị bàn tiệc chu đáo nhất.</p>
            
            <form action="?url=reservation/process" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" name="customer_name" placeholder="Họ và tên của bạn *" required style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
                <input type="text" name="customer_phone" placeholder="Số điện thoại di động *" required style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
                <input type="datetime-local" name="reservation_time" required style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
                <input type="number" name="guests" placeholder="Số lượng khách *" required min="1" style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
                <textarea name="message" placeholder="Ghi chú yêu cầu món ăn đặc sản, số bàn..." rows="2" style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px; resize:none;"></textarea>
                
                <button type="submit" style="padding:12px; background:linear-gradient(135deg, var(--accent), var(--primary)); color:#fff; border:none; border-radius:6px; font-weight:bold; font-size:15px; text-transform:uppercase; cursor:pointer; transition:var(--transition); margin-top:5px;">XÁC NHẬN ĐẶT NGAY</button>
            </form>
        </div>
    </div>

    <script>
        function openBookingModal() {
            document.getElementById('modalBooking').style.display = 'flex';
        }
        function closeBookingModal() {
            document.getElementById('modalBooking').style.display = 'none';
        }
    </script>
</body>

</html>