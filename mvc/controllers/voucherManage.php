<?php

class voucherManage extends ControllerBase
{
    public function index()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }

        // Khởi tạo model
        $voucher = $this->model("voucherModel");
        $voucherList = ($voucher->getAll())->fetch_all(MYSQLI_ASSOC);

        $this->view("admin/voucher", [
            "headTitle" => "Quản lý voucher",
            "voucherList" => $voucherList
        ]);
    }

    public function add()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Khởi tạo model
            $voucher = $this->model("voucherModel");
            // Gọi hàm insert để thêm mới vào csdl
            $result = $voucher->insert($_POST);
            if ($result) {
                $this->view("admin/addNewVoucher", [
                    "headTitle" => "Quản lý voucher",
                    "cssClass" => "success",
                    "message" => "Thêm mới thành công!",
                    // "name" => $_POST['name']
                ]);
            } else {
                $this->view("admin/addNewVoucher", [
                    "headTitle" => "Quản lý voucher",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "name" => $_POST['name']
                ]);
            }
        } else {
            $this->view("admin/addNewVoucher", [
                "headTitle" => "Thêm mới voucher",
                "cssClass" => "none",
            ]);
        }
    }

    public function changeStatus($id)
    {
        $voucher = $this->model("voucherModel");
        $result = $voucher->changeStatus($id);
        if ($result) {
            $this->redirect("voucherManage");
        }
    }

    public function edit($id)
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }

        // Khởi tạo model
        $voucher = $this->model("VoucherModel");

        // Lấy thông tin voucher cần sửa
        $voucherInfo = $voucher->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin voucher được submit từ form
            $voucherData = [
                "percentDiscount" => $_POST['percentDiscount'],
                "quantity" => $_POST['quantity'],
                "code" => $_POST['code'],
                "expirationDate" => $_POST['expirationDate'],
                "status" => $_POST['status']
            ];

            // Gọi hàm update để cập nhật voucher vào csdl
            $result = $voucher->update($id, $voucherData);

            if ($result) {
                $this->view("admin/editVoucher", [
                    "headTitle" => "Quản lý voucher",
                    "cssClass" => "success",
                    "message" => "Cập nhật voucher thành công!",
                    "voucherInfo" => $voucherInfo
                ]);
            } else {
                $this->view("admin/editVoucher", [
                    "headTitle" => "Quản lý voucher",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "voucherInfo" => $voucherInfo
                ]);
            }
        } else {
            $this->view("admin/editVoucher", [
                "headTitle" => "Cập nhật voucher",
                "cssClass" => "none",
                "voucherInfo" => $voucherInfo
            ]);
        }
    }


    public function delete($id)
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }
        $product = $this->model("VoucherModel");
        $result = $product->delete($id);
        if ($result) {
            $this->redirect("voucherManage");
        }
    }
}
