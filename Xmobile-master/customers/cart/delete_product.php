<?php
session_start();
//Lấy id của tài khoản đang đăng nhập
$customer_id = $_SESSION['customer_id'];
// Mở kết nối
include_once '../../Connection/open.php';

// Lấy product_id từ URL
$product_id = $_GET['id'];

// Xóa sản phẩm khỏi tất cả các giỏ hàng (mọi cart_id)
$sqlDelete = "DELETE FROM cart_details WHERE Product_id = '$product_id'";
mysqli_query($connection, $sqlDelete);

// Đóng kết nối
include_once '../../Connection/close.php';

// Quay về trang quản lý đơn hàng
header("Location: ../index.php?action=giohang&id=$customer_id");
?>
