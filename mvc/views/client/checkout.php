<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
  <?php
  $cart = new cart();
  if (!isset($_SESSION['cart'])) {
    $total = (isset($cart->getTotalQuantitycart()['total']) ? $cart->getTotalQuantitycart()['total'] : 0);
  } else {
    $total = $cart->getTotal();
  }

  $category = $this->model("categoryModel");
  $result = $category->getAllClient();
  $listCategory = $result->fetch_all(MYSQLI_ASSOC);
  ?>
  <nav class="navbar">
    <div class="logo">NGAN'S STORE</div>
    <div class="search-container">
      <form action="<?= URL_ROOT ?>/product/search" method="get">
        <input type="text" class="search" placeholder="Tìm kiếm.." name="keyword">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <ul class="nav-links">
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <div class="menu">
        <li><a href="<?= URL_ROOT ?>">Trang chủ <i class="fa fa-home"></i></a></li>
        <li class="cate">
          <a href="#">Danh mục <i class="fa fa-list-ul"></i></a>
          <ul class="sub-menu">
            <?php
            foreach ($listCategory as $key) { ?>
              <li><a href="<?= URL_ROOT . '/product/category/' . $key['id'] ?>?page=1"><?= $key['name'] ?></a></li>
            <?php }
            ?>
          </ul>
        </li>
        <li><a href="<?= URL_ROOT . "/blog" ?>">Blog <i class="fa fa-book"></i></a></li>

        <?php
        if (isset($_SESSION['user_id'])) { ?>
          <li class="cate">
            <a href="#"><?= $_SESSION['user_name'] ?> <i class="fa fa-user-circle"></i></a>
            <ul class="sub-menu">
              <li><a href="<?= URL_ROOT . "/user/info" ?>">Thông tin tài khoản <i class="fa fa-user"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/favorite" ?>">Sản phẩm yêu thích <i class="fa fa-heart"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/viewed" ?>">Đã xem <i class="fa fa-history"></i></a></li>
              <li><a href="<?= URL_ROOT . "/order/checkout" ?>">Đơn hàng của tôi <i class="fa fa-list-alt"></i></a></li>
              <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất <i class="fa fa-sign-out"></i></a></li>
            </ul>
          </li>
        <?php  } else { ?>
          <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký <i class="fa fa-pencil-square"></i></a></li>
          <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập <i class="fa fa-sign-in"></i></a></li>
        <?php  }
        ?>
        <li class="menu-active"><a href="<?= URL_ROOT . "/cart/checkout" ?>" id="bag">Giỏ hàng <i class="fa fa-shopping-bag"></i> (<?= is_null($total) ? 0 : $total ?>)</a></li>
      </div>
    </ul>
  </nav>
  <div class="banner">

  </div>
  <div class="title">Giỏ hàng của tôi</div>
  <table id="table">

    <?php
    $count = 0;
    $total = 0;
    if (isset($data['cart']) && count($data['cart']) > 0) { ?>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thao tác</th>
      </tr>
      <?php foreach ($data['cart'] as $key => $value) {
        $total += $value['productPrice'] * $value['quantity'];
      ?>
        <tr>
          <td><?= ++$count ?></td>
          <td><?= $value['productName'] ?></td>
          <td><img class="img-table" src="<?= URL_ROOT . '/public/images/product/' . $value['image'] ?>" alt=""></td>
          <td><input type="number" min="1" class="qty" name="" id="<?= $value['productId'] ?>" value="<?= $value['quantity'] ?>" onchange="update(this)"></td>
          <td><?= number_format($value['productPrice'], 0, '', ',') ?>₫</td>
          <td><a href="<?= URL_ROOT . '/cart/removeItemcart/' . $value['productId'] ?>" class="rm-item-cart"><i class="fa fa-trash"></i></a></td>
        </tr>
      <?php }
      ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
        </td>
        <td>Tổng tiền</td>
        <?php
        if (isset($_SESSION['voucher'])) { ?>
          <td>Đã áp dụng mã giảm giá: (<?= $_SESSION['voucher']['code'] . ') -' . $_SESSION['voucher']['percentDiscount'] ?>% <a href="<?= URL_ROOT ?>/cart/cancelVoucher">(Hủy)</a><br> <del><?= number_format(($total), 0, '', ',') ?>₫ <br> </del><?= number_format($total - ($total / 100 * $_SESSION['voucher']['percentDiscount']), 0, '', ',') ?>₫</td>
        <?php } else { ?>
          <td><?= number_format(($total), 0, '', ',') ?>₫</td>
        <?php }
        ?>
      </tr>
    <?php } else {  ?>
      <h3 style="text-align: center;">Giỏ hàng hiện đang trống...</h3>
    <?php }  ?>
  </table>
  

  <div class="login">
    <form action="<?= URL_ROOT ?>/cart/check" class="login-container" method="post">
      <!-- <input type="text" placeholder="Nhập mã giảm giá (nếu có)" name="code" required> -->
      <p>
        <?php
          // Lớp model để lấy danh sách các mã giảm giá từ cơ sở dữ liệu
          class VoucherModel {
            public function getAll() {
              $db = DB::getInstance();
              $sql = "SELECT * FROM vouchers";
              $result = mysqli_query($db->con, $sql);
              return $result;
            }
          }

          // Khởi tạo đối tượng voucherModel và lấy danh sách các mã giảm giá từ cơ sở dữ liệu
          $voucherModel = new VoucherModel();
          $voucherList = $voucherModel->getAll();
        ?>
        <?php foreach ($voucherList as $voucher) { ?>
          <select name="code" style="font-size:x-large;">
            <option value="" selected>Chọn mã giảm giá</option>
            <?php foreach ($voucherList as $voucher) { ?>
              <option value="<?= $voucher['code'] ?>">
                Mã: <?= $voucher['code'] ?> - Giảm: <?= $voucher['percentDiscount'] ?>%
              </option>
            <?php } ?>
          </select>
          <br>
        <?php } ?>
      </p>
      <p class="<?= isset($data['cssClass']) ? $data['cssClass'] : "" ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
      <p><input type="submit" value="Áp dụng"></p>
    </form>
  </div>

  <div class="payment">
    <?php
    if (isset($_SESSION['user_id']) && count($data['cart']) > 0) {
      if (isset($_SESSION['voucher'])) { ?>
        <div class="login">
          <h3>Phương thức thanh toán</h3>
          <form action="<?= URL_ROOT ?>/order/add" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <label for="cod">Thanh toán tiền mặt khi nhận hàng (COD)</label>
            <input type="radio" id="cod" id="cod" name="paymentMethod" value="cod" checked>
            <img style="height: 50px;" src="<?= URL_ROOT ?>/public/images/wallet.jpg" alt="" srcset=""><br>
           
            <label for="momo">Ví điện tử MOMO</label>
            <input type="radio" id="momo" name="paymentMethod" value="momo">
            <img style="height: 50px;" id="momo"  src="<?= URL_ROOT ?>/public/images/momo.png" alt="" srcset=""> <br>
            <button type="submit" class="cart-btn">Đặt hàng ngay</button>
          </form>
        </div>
      <?php } else if (isset($_SESSION['cart'])) { ?>
        <div class="login">
          <h3>Phương thức thanh toán</h3>
          <form action="<?= URL_ROOT ?>/order/add" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <label for="cod">Thanh toán tiền mặt khi nhận hàng (COD)</label>
            <input type="radio" id="cod" id="cod" name="paymentMethod" value="cod" checked>
            <img style="height: 50px;" src="<?= URL_ROOT ?>/public/images/wallet.jpg" alt="" srcset=""><br>
            
            <label for="momo">Ví điện tử MOMO</label>
            <input type="radio" id="momo" name="paymentMethod" value="momo">
            <img style="height: 50px;" id="momo" src="<?= URL_ROOT ?>/public/images/momo.png" alt="" srcset=""> <br>
            <button type="submit" class="cart-btn">Đặt hàng ngay</button>
          </form>
        </div>
      <?php } else { ?>
        <div class="login">
          <h3>Phương thức thanh toán</h3>
          <form action="<?= URL_ROOT ?>/order/add" method="post">
            <input type="hidden" name="total" value="<?= $total ?>">
            <label for="cod">Thanh toán tiền mặt khi nhận hàng (COD)</label>
            <input type="radio" id="cod" id="cod" name="paymentMethod" value="cod" checked>
            <img style="height: 50px;" src="<?= URL_ROOT ?>/public/images/wallet.jpg" alt="" srcset=""><br>
            
            <label for="momo">Ví điện tử MOMO</label>
            <input type="radio" id="momo" name="paymentMethod" value="momo">
            <img style="height: 50px;" id="momo" src="<?= URL_ROOT ?>/public/images/momo.png" alt="" srcset=""> <br>
            <button type="submit" class="cart-btn">Đặt hàng ngay</button>
          </form>
        </div>
      <?php } ?>
    <?php } else { ?>
      <a class="cart-btn" href="<?= URL_ROOT . '/user/login/' ?>">Đăng nhập để mua hàng</a>
    <?php }
    ?>
  </div>
  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>

  <script>
  function update(element) {
    var productId = element.id;
    var quantity = element.value;
    var url = "<?php echo URL_ROOT . '/cart/updateItemcart/' ?>" + productId + '/' + quantity;
    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
      } else {
        alert(data.message);
      }

    })
    .catch((error) => {
      console.error('Error:', error);
    });
    location.reload();
  }
  </script>

</body>
</html>