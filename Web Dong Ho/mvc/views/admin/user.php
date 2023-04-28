<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <a href="<?= URL_ROOT . '/userManage/add' ?>" class="button right"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                        <h3>Danh sách Người dùng</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ Tên</th>
                                        <th>Email</th>
                                        <th>Captcha</th>
                                        <th>Địa chỉ</th>
                                        <th>Chức Vụ</th>
                                        <th>Trạng Thái</th>
                                        <th>Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['userList'] as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['fullName'] ?></td>
                                            <td><?= $value['email'] ?></td>
                                            <td><?= $value['captcha'] ?></td>
                                            <td><?= $value['address'] ?></td>
                                            <td><?= $value['roleId'] == 1 ? 'Admin' : 'Người dùng' ?></td>
                                            <td style="color: <?= $value['isConfirmed'] == 0 ? 'red' : 'green' ?>; font-weight: bold;"><?= $value['isConfirmed'] == 0 ? 'Chưa xác nhận' : 'Đã xác nhận' ?></td>
                                            <td>
                                                
                                                <?php if ($value['roleId'] != 1) { ?>
                                                    <a href="<?= URL_ROOT . '/userManage/delete/' . $value['id'] ?>" class="button-red" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>