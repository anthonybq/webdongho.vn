<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Xem/Sửa người dùng</h3>
                        <div class="form">
                            <form action="<?= URL_ROOT . '/userManage/edit' ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <p class="<?= $data['cssClass'] ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
                                <label for="email">Tên người dùng</label>
                                <input type="text" id="email" name="email" required value="<?= $data['email'] ?>">
                                <input type="submit" value="Lưu">
                                <a href="<?= URL_ROOT . '/userManage' ?>" class="back">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>
