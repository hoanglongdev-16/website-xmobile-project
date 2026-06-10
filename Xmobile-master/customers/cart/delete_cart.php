<?php
session_start();
//Lấy id của tài khoản đang đăng nhập
$customer_id = $_SESSION['customer_id'];

// Mở kết nối
include_once '../../Connection/open.php';

// Lấy Cart_id của khách hàng
$sqlCart = "SELECT Id FROM carts WHERE Customer_id = '$customer_id'";
$resultCart = mysqli_query($connection, $sqlCart);

// Lấy ID sản phẩm từ URL
$id = $_GET['id'];

// Xóa toàn bộ sản phẩm trong cart_details
$sqlDeleteDetails = "DELETE FROM cart_details WHERE Cart_id = '$id'";
mysqli_query($connection, $sqlDeleteDetails);

// Đóng kết nối
include_once '../../Connection/close.php';

// Quay lại trang giỏ hàng
header("Location: ../index.php?action=giohang&id=$customer_id");
?>
