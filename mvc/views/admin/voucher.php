<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <div>
                            <div class="right">
                                <form method="get" style="width:200px;">
                                    <span style="position:relative;">
                                        <input type="text" name="q" placeholder="Tìm kiếm..." style="padding-left:30px;">
                                        <i class="fa fa-search" aria-hidden="true" style="position:absolute; left:10px; top:8px;"></i>
                                    </span>
                                </form>
                            </div>
                            <a href="<?= URL_ROOT . '/voucherManage/add' ?>" class="button" style="margin: 10px;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                        </div>
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
                                        // Ẩn tất cả voucher ngoại trừ những voucher có thông tin tìm kiếm
                                        if(isset($_GET['q']) && (strpos($value['code'], $_GET['q']) === false && strpos($value['percentDiscount'], $_GET['q']) === false)) {
                                            continue;
                                        }
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