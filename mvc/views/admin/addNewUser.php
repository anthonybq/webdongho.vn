<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">
        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Thêm mới Người dùng</h3>
                        <div class="form">
                            <form action="<?= URL_ROOT . '/userManage/add' ?>" method="POST">
                                <p class="<?= $data['cssClass'] ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
                                <label for="fullName">Họ tên</label>
                                <input type="text" name="fullName" required>
                                <label for="email">Email</label>
                                <input type="email" name="email" required>
                                <label for="dob">Ngày sinh</label>
                                <input type="date" name="dob" required>
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" required>
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" required>
                                <label for="roleId">Vai trò</label>
                                <select name="roleId" required>
                                    <option value="1">Quản trị viên</option>
                                    <option value="2">Người dùng</option>
                                </select>
                                <label for="status">Trạng thái</label>
                                <select name="status" required>
                                    <option value="1">Hoạt động</option>
                                    <option value="2">Không hoạt động</option>
                                </select>
                                <label for="isConfirmed">Xác nhận</label>
                                <select name="isConfirmed" required>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="0">Chưa xác nhận</option>
                                </select>
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone" required>

                                <p><select for="provinceId" name="ls_province" required></select></p>
                                <p><select for="districtId" name="ls_district" required></select></p>
                                <p><select for="wardId" name="ls_ward" required></select></p>

                                <!-- <label for="provinceId">Tỉnh/Thành phố</label>
                                <input type="text" name="provinceId" required>
                                <label for="districtId">Quận/Huyện</label>
                                <input type="text" name="districtId" required>
                                <label for="wardId">Phường/Xã</label>
                                <input type="text" name="wardId" required> -->
                                <input type="submit" value="Lưu">
                                <a href="<?= URL_ROOT . '/userManage' ?>" class="back">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
    <script src="<?= URL_ROOT ?>/public/js/vietnamlocalselector.js"></script>
    <script>
    var localpicker = new LocalPicker({
      province: "ls_province",
      district: "ls_district",
      ward: "ls_ward"
    });
  </script>
</body>

</html>