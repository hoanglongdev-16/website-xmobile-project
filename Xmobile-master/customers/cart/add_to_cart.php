<?php
session_start();

// Mở kết nối
include_once "../../Connection/open.php";
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../login/login.php");
}
// Lấy id của Customer đang đăng nhập
$Customer_id = $_SESSION['customer_id'];

// Lấy id của sản phẩm đang được thêm vào cart
$productId = $_GET['id'];

// Kiểm tra trên DB đã tồn tại cart của Customer chưa
$sqlCheckCart = "SELECT *, COUNT(Id) AS count_id FROM carts WHERE Customer_id = '$Customer_id'";
$checkCarts = mysqli_query($connection, $sqlCheckCart);

foreach ($checkCarts as $checkCart) {
    // Nếu chưa có cart, tạo mới
    if ($checkCart['count_id'] == 0) {
        $sqlCreateCart = "INSERT INTO carts (Customer_id) VALUES ('$Customer_id')";
        mysqli_query($connection, $sqlCreateCart);

        // Lấy ID cart vừa tạo
        $sqlGetCartId = "SELECT Id FROM carts WHERE Customer_id = '$Customer_id'";
        $getCartIds = mysqli_query($connection, $sqlGetCartId);
        foreach ($getCartIds as $getCartId) {
            $cartId = $getCartId['Id'];
        }

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $sqlCheckProduct = "SELECT *, COUNT(Product_id) AS count_product FROM cart_details 
                            WHERE Cart_id = '$cartId' AND Product_id = '$productId'";
        $checkProducts = mysqli_query($connection, $sqlCheckProduct);
        foreach ($checkProducts as $checkProduct) {
            if ($checkProduct['count_product'] == 0) {
                $quantity = 1;
                $sql = "INSERT INTO cart_details (Cart_id, Product_id, Quantity) VALUES ('$cartId', '$productId', '$quantity')";
            } else {
                $quantity = $checkProduct['Quantity'] + 1;
                $sql = "UPDATE cart_details SET Quantity = '$quantity' WHERE Cart_id = '$cartId' AND Product_id = '$productId'";
            }
            mysqli_query($connection, $sql);
        }
    } else {
        // Nếu đã có cart
        $sqlGetCartId = "SELECT Id FROM carts WHERE Customer_id = '$Customer_id'";
        $getCartIds = mysqli_query($connection, $sqlGetCartId);
        foreach ($getCartIds as $getCartId) {
            $cartId = $getCartId['Id'];
        }

        // Kiểm tra sản phẩm trong cart
        $sqlCheckProduct = "SELECT *, COUNT(Product_id) AS count_product FROM cart_details 
                            WHERE Cart_id = '$cartId' AND Product_id = '$productId'";
        $checkProducts = mysqli_query($connection, $sqlCheckProduct);
        foreach ($checkProducts as $checkProduct) {
            if ($checkProduct['count_product'] == 0) {
                $quantity = 1;
                $sql = "INSERT INTO cart_details (Cart_id, Product_id, Quantity) VALUES ('$cartId', '$productId', '$quantity')";
            } else {
                $quantity = $checkProduct['Quantity'] + 1;
                $sql = "UPDATE cart_details SET Quantity = '$quantity' WHERE Cart_id = '$cartId' AND Product_id = '$productId'";
            }
            mysqli_query($connection, $sql);
        }
    }
}
// quay về trang trước đó 
header("Location: ../index.php?action=chitietsanpham&id=$productId");
?>
