<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Xem/Sửa danh mục</h3>
                        <div class="form">
                        <form action="<?= URL_ROOT . 'voucherManage/edit/' . $data['id'] ?>" method="POST">
                                <div class="form-group">
                                    <label for="percentDiscount">Phần trăm giảm giá:</label>
                                    <input type="text" class="form-control" id="percentDiscount" name="percentDiscount" value="<?php echo $data['percentDiscount']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Số lượng:</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $data['quantity']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="code">Mã:</label>
                                    <input type="text" class="form-control" id="code" name="code" value="<?php echo $data['code']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="expirationDate">Ngày hết hạn:</label>
                                    <input type="date" class="form-control" id="expirationDate" name="expirationDate" value="<?php echo $data['expirationDate']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Trạng thái:</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Active" <?php if ($data['status'] == 'Active') echo 'selected'; ?>>Kích hoạt</option>
                                        <option value="Inactive" <?php if ($data['status'] == 'Inactive') echo 'selected'; ?>>Không kích hoạt</option>
                                    </select>
                                </div>
                                <input type="submit" value="Lưu">
                                <a href="<?= URL_ROOT . '/voucherManage' ?>" class="back">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>