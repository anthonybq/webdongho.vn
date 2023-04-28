<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <a href="<?= URL_ROOT . '/voucherManage/add' ?>" class="button right"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                        <h3>Danh sách Voucher</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Code</th>
                                        <th>Phần trăm giảm</th>
                                        <th>Số lượng</th>
                                        <th>Đã dùng</th>
                                        <th>Ngày hết hạn</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['voucherList'] as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['code'] ?></td>
                                            <td>-<?= $value['percentDiscount'] ?>%</td>
                                            <td><?= $value['quantity'] ?></td>
                                            <td><?= $value['usedCount'] ?></td>
                                            <td><?= date("d/m/Y", strtotime($value['expirationDate'])) ?></td>
                                            <?php
                                            if ($value['status']) { ?>
                                                <td><span class="active"><i class="fa fa-unlock" aria-hidden="true"></i></span></td>
                                            <?php } else { ?>
                                                <td><span class="block"><i class="fa fa-lock" aria-hidden="true"></i></span></td>
                                            <?php }
                                            ?>
                                            <td>
                                                <?php
                                                if ($value['status']) { ?>
                                                    <a class="button-red" href="<?= URL_ROOT . '/voucherManage/changeStatus/' . $value['id'] ?>"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                                <?php } else { ?>
                                                    <a class="button-green" href="<?= URL_ROOT . '/voucherManage/changeStatus/' . $value['id'] ?>"><i class="fa fa-unlock" aria-hidden="true"></i></a>
                                                <?php }
                                                ?>
                                                </a>
                                                <!-- <a class="button-normal" href="<?= URL_ROOT . '/voucherManage/edit/' . $value['id'] ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                                                <a href="<?= URL_ROOT . '/voucherManage/delete/' . $value['id'] ?>" class="button-red" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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