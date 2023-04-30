<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">

        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <form method="get" style="width:200px;">
                            <span style="position:relative;">
                                <input type="text" name="q" placeholder="Tìm kiếm..." style="padding-left:30px;">
                                <i class="fa fa-search" aria-hidden="true" style="position:absolute; left:10px; top:8px;"></i>
                            </span>
                        </form>
                        <h3>Đơn hàng</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã HD</th>
                                        <th>Tên khách hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tình trạng</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['orderList'] as $key => $value) {
                                        // Ẩn tất cả đơn hàng ngoại trừ những đơn hàng có thông tin tìm kiếm
                                        if(isset($_GET['q']) && (strpos($value['fullName'], $_GET['q']) === false)) {
                                            continue;
                                        }
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['orderId'] ?></td>
                                            <td><?= $value['fullName'] ?></td>
                                            <td><?= date("d/m/Y", strtotime($value['createdDate'])) ?></td>
                                            <?php
                                            if ($value['status'] == "processing") { ?>
                                                <td><span class="gray">Chưa xác nhận</span></td>
                                            <?php  } else if ($value['status'] == "processed") { ?>
                                                <td><span class="blue">Đã xác nhận</span></td>
                                            <?php } else if ($value['status'] == "delivery") { ?>
                                                <td><span class="yellow">Đang giao hàng</span></td>
                                            <?php } else if ($value['status'] == "cancel"){ ?>
                                                <td><span class="gray">Đã hủy</span></td>
                                            <?php } else if ($value['status'] == "received"){ ?>
                                                <td><span class="active">Hoàn thành</span></td>
                                            <?php } else{ ?>
                                                <td><span class="gray">...</span></td>
                                            <?php }
                                            ?>
                                            <td><?= $value['paymentMethod'] ?></td>
                                            <?php
                                            if ($value['paymentStatus']) { ?>
                                                <td><span class="active">Đã thanh toán</span></td>
                                            <?php } else { ?>
                                                <td><span class="gray">Chưa thanh toán</span></td>
                                            <?php }
                                            ?>
                                            <td><a href="<?= URL_ROOT . '/orderManage/detail/' . $value['orderId'] ?>">Chi tiết</a></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <a href="<?= URL_ROOT ?>/orderManage?page=<?= (isset($_GET['page'])) ? (($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1) : 1 ?>">&laquo;</a>
                            <?php
                            if (isset($data['countPaging'])) {
                                for ($i = 1; $i <= $data['countPaging']; $i++) {
                                    if (isset($_GET['page'])) {
                                        if ($i == $_GET['page']) { ?>
                                            <a class="active" href="<?= URL_ROOT ?>/orderManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php } else { ?>
                                            <a href="<?= URL_ROOT ?>/orderManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php  }
                                    } else {
                                        if ($i == 1) { ?>
                                            <a class="active" href="<?= URL_ROOT ?>/orderManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php  } else { ?>
                                            <a href="<?= URL_ROOT ?>/orderManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php   } ?>
                                    <?php  } ?>
                            <?php }
                            }
                            ?>
                            <a href="<?= URL_ROOT ?>/orderManage?page=<?= (isset($_GET['page'])) ? ($_GET['page'] == $data['countPaging'] ? $_GET['page'] : $_GET['page'] + 1) : 2 ?>">&raquo;</a>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>