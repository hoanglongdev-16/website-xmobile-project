<?php
    session_start();
    //Lấy id của tài khoản đang đăng nhập
    $customer_id = $_SESSION['customer_id'];

    // Mở kết nối
    include_once '../../connection/open.php';

    // Lấy danh sách sản phẩm từ form POST, trong đó key là cart_id + product_id
    $carts = $_POST["cart"];

    // Duyệt từng sản phẩm để cập nhật
    foreach ($carts as $cartId => $products) {
        foreach ($products as $productId => $quantity) {
            // SQL cập nhật số lượng
            $sql = "UPDATE cart_details SET Quantity = '$quantity' WHERE Cart_id = '$cartId' AND Product_id = '$productId'";
            mysqli_query($connection, $sql);
        }
    }

    // Đóng kết nối
    include_once '../../connection/close.php';

    // Quay lại trang quản lý
    header("location: ../index.php?action=giohang&id=$customer_id");
?>
