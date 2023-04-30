<?php
    class userManage extends ControllerBase
    {
        public function index()
        {
            // Kiểm tra xem người dùng có quyền truy cập trang này không
            if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
                $this->redirect("home");
            }

            // Khởi tạo model
            $user = $this->model("userModelad");

            // Lấy danh sách người dùng từ cơ sở dữ liệu
            $userList = ($user->getAll())->fetch_all(MYSQLI_ASSOC);

            // Hiển thị view với dữ liệu danh sách người dùng
            $this->view("admin/user", [
                "headTitle" => "Quản lý người dùng",
                "userList" => $userList
            ]);
        }

        public function add()
        {
            // Kiểm tra xem người dùng có quyền truy cập trang này không
            if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
                $this->redirect("home");
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Khởi tạo model
                $user = $this->model("userModelad");

                // Gọi hàm insert để thêm người dùng mới vào cơ sở dữ liệu
                $result = $user->insert($_POST);

                if ($result) {
                    $this->view("admin/addNewUser", [
                        "headTitle" => "Quản lý người dùng",
                        "cssClass" => "success",
                        "message" => "Thêm mới thành công!",
                        "email" => $_POST['email']
                    ]);
                } else {
                    $this->view("admin/addNewUser", [
                        "headTitle" => "Quản lý người dùng",
                        "cssClass" => "error",
                        "message" => "Lỗi, vui lòng thử lại sau!",
                        "email" => $_POST['email']
                    ]);
                }
            } else {
                $this->view("admin/addNewUser", [
                    "headTitle" => "Thêm mới người dùng",
                    "cssClass" => "none",
                ]);
            }
        }

        public function edit($id = "")
        {
            if (isset($_SESSION['roleId']) && $_SESSION['roleId'] != 'Admin') {
                $this->redirect("home");
            }
            
            // Khởi tạo model
            $user = $this->model("userModelad");
            // Gọi hàm getById
            $u = $user->getById($id);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Gọi hàm update
                $r = $user->update($_POST['id'], $_POST['fullName'], $_POST['email'], $_POST['dob'], $_POST['address'], $_POST['password'], $_POST['roleId'], $_POST['status'], $_POST['captcha'], $_POST['isConfirmed'], $_POST['phone'], $_POST['provinceId'], $_POST['districtId'], $_POST['wardId']);

                // Gọi hàm getById
                $new = $user->getById($_POST['id']);
                if ($r) {
                    $this->view("admin/editUser", [
                        "headTitle" => "Xem/Cập nhật người dùng",
                        "cssClass" => "success",
                        "message" => "Cập nhật thành công!",
                        "user" => $new->fetch_assoc()
                    ]);
                } else {
                    $this->view("admin/editUser", [
                        "headTitle" => "Xem/Cập nhật người dùng",
                        "cssClass" => "error",
                        "message" => "Lỗi, vui lòng thử lại sau!",
                        "user" => $new->fetch_assoc()
                    ]);
                }
            } else {
                $this->view("admin/editUser", [
                    "headTitle" => "Xem/Cập nhật người dùng",
                    "cssClass" => "none",
                    "user" => $u->fetch_assoc()
                ]);
            }
        }

        public function changeStatus($id)
        {
            // Khởi tạo model
            $user = $this->model("userModelad");

            // Gọi hàm changeStatus để thay đổi trạng thái của người dùng
            $result = $user->changeStatus($id);

            if ($result) {
                $this->redirect("userManage");
            }
        }
        public function delete($id)
        {
            // Kiểm tra xem người dùng có quyền truy cập trang này không
            if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
                $this->redirect("home");
            }

            // Khởi tạo model
            $user = $this->model("userModelad");

            // Gọi hàm delete để xóa người dùng
            $result = $user->delete($id);

            if ($result) {
                $this->redirect("userManage");
            } else {
                // Hiển thị thông báo lỗi nếu không xóa được người dùng
                $this->view("admin/user", [
                    "headTitle" => "Quản lý người dùng",
                    "message" => "Không thể xóa người dùng này. Vui lòng thử lại sau.",
                    "cssClass" => "error"
                ]);
            }
        }   

    }
?>