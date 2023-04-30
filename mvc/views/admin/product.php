<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">
        <header>
        </header>
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
                            <a href="<?= URL_ROOT . '/productManage/add' ?>" class="button" style="margin: 10px;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                        </div>
                        <h3>Danh sách sản phẩm</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Ngày tạo</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['productList'] as $key => $value) {
                                        // Ẩn tất cả sản phẩm ngoại trừ những sản phẩm có thông tin tìm kiếm
                                        if(isset($_GET['q']) && (strpos($value['name'], $_GET['q']) === false && strpos($value['energyused'], $_GET['q']) === false)) {
                                            continue;
                                        }
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['name'] ?></td>
                                            <td><img class="img" src="<?= URL_ROOT . '/public/images/product/' . $value['image'] ?>" alt=""></td>
                                            <td><?= date("d/m/Y", strtotime($value['createdDate'])) ?></td>
                                            <?php
                                            if ($value['status']) { ?>
                                                <td><span class="active">Kích hoạt</span></td>
                                            <?php } else { ?>
                                                <td><span class="block">Khóa</span></td>
                                            <?php }
                                            ?>
                                            <td>
                                                <?php
                                                if ($value['status']) { ?>
                                                    <a class="button-red" href="<?= URL_ROOT . '/productManage/changeStatus/' . $value['id'] ?>"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                                <?php } else { ?>
                                                    <a class="button-green" href="<?= URL_ROOT . '/productManage/changeStatus/' . $value['id'] ?>"><i class="fa fa-unlock" aria-hidden="true"></i></a>
                                                <?php }
                                                ?>
                                                </a>
                                                <a class="button-normal" href="<?= URL_ROOT . '/productManage/edit/' . $value['id'] ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="<?= URL_ROOT . '/productManage/delete/' . $value['id'] ?>" class="button-red" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <a href="<?= URL_ROOT ?>/productManage?page=<?= (isset($_GET['page'])) ? (($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1) : 1 ?>">&laquo;</a>
                            <?php
                            if (isset($data['countPaging'])) {
                                for ($i = 1; $i <= $data['countPaging']; $i++) {
                                    if (isset($_GET['page'])) {
                                        if ($i == $_GET['page']) { ?>
                                            <a class="active" href="<?= URL_ROOT ?>/productManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php } else { ?>
                                            <a href="<?= URL_ROOT ?>/productManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php  }
                                    } else {
                                        if ($i == 1) { ?>
                                            <a class="active" href="<?= URL_ROOT ?>/productManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php  } else { ?>
                                            <a href="<?= URL_ROOT ?>/productManage?page=<?= $i ?>"><?= $i ?></a>
                                        <?php   } ?>
                                    <?php  } ?>
                            <?php }
                            }
                            ?>
                            <a href="<?= URL_ROOT ?>/productManage?page=<?= (isset($_GET['page'])) ? ($_GET['page'] == $data['countPaging'] ? $_GET['page'] : $_GET['page'] + 1) : 2 ?>">&raquo;</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>