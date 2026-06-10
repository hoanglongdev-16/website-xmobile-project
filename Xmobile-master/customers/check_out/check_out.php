<?php
session_start();
//lấy id của người dùng đang đăng nhập
$customer_id = $_SESSION['customer_id'];
$receiver_name = $_POST['receiver_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];
// Kết nối DB
include_once "../../Connection/open.php";

// Lấy sản phẩm trong giỏ hàng
$sql_get_cart = "SELECT 
    cart_details.Product_id,
    cart_details.Quantity,
    products.Price
FROM carts
JOIN cart_details ON carts.Id = cart_details.Cart_id
JOIN products ON products.Id = cart_details.Product_id
WHERE carts.Customer_id = '$customer_id'";

$carts = mysqli_query($connection, $sql_get_cart);

// Lưu dữ liệu lên bảng orders
//ngày đặt hàng
$order_date = date("Y-m-d");
//status = 0
$order_status = 0;

// Thêm đơn hàng vào bảng orders
$sql_insert_order = "INSERT INTO orders (Customer_id, Order_date, Order_status, Delivery_location, Receiver_name, Receiver_phone, Payment_method ) 
    VALUES ('$customer_id', '$order_date', '$order_status', '$address', '$receiver_name', '$phone', '$payment_method')";

mysqli_query($connection, $sql_insert_order);

//lấy id của order vừa được tạo
//viết sql 
$sql_get_order_id = "SELECT Id FROM orders WHERE Customer_id = '$customer_id' AND Order_date = '$order_date' AND Order_status = '$order_status' AND Delivery_location = '$address' AND Receiver_name = '$receiver_name' AND Receiver_phone = '$phone' AND Payment_method = '$payment_method'";
//chạy sql
$get_order_ids = mysqli_query($connection, $sql_get_order_id);
//lấy order_id
foreach ($get_order_ids as $get_order_id) {
    $order_id = $get_order_id['Id'];
}
//lưu order_details
foreach ($carts as $cart) {
    $product_id = $cart['Product_id'];
    $quantity = $cart['Quantity'];
    //lấy giá sản phẩm
    $sql_get_price = "SELECT Price FROM products WHERE Id = '$product_id'";
    //chạy query
    $result = mysqli_query($connection, $sql_get_price);
    //lấy price
    foreach ($result as $getprice) {
        $price = $getprice['Price'];
    }
    // lưu dữ liệu vào bảng order_details
    //viết sql
    $sql_insert_order_detail = "INSERT INTO order_details (Order_id, Product_id, Quantity, Price) 
        VALUES ('$order_id', '$product_id', '$quantity', '$price')";
    //chạy query
    mysqli_query($connection, $sql_insert_order_detail);
}
// Xóa giỏ hàng sau khi đặt hàng
$sql_delete_cart = "DELETE FROM cart_details WHERE Cart_id IN (SELECT Id FROM carts WHERE Customer_id = '$customer_id')";
mysqli_query($connection, $sql_delete_cart);
// Đóng kết nối
include_once "../../Connection/close.php";

// Chuyển hướng hoặc hiển thị thông báo
header("location: ../index.php?action=lichsumuahang");
?>
