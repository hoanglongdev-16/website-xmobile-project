<?php
    //Mở kết nối
    include_once "../../connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM payment_method";
    //Chạy sql
    $result = mysqli_query($connection, $sql);
    // Kiểm tra xem có dữ liệu không
    $payment_method = mysqli_fetch_assoc($result);
    //Đóng kết nối
    include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_create_edit.css">

<h2>Thêm phương thức thanh toán</h2>
<form method="post" action="payment_methods/store.php">
    <label for="name">Tên Phương Thức Thanh Toán: &nbsp;</label>
    <input type="text" name="name" id="name"><br>
<br>
    <div>
        <a href="index.php?action=quanlyphuongthucthanhtoan"><button type="button">Thoát</button></a>
        <button type="submit">Thêm phương thức thanh toán</button>
    </div>
</form>
