<?php
    //Lấy dữ liệu trong form
    $name = $_POST["name"];
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Viết sql
    $sql = "INSERT INTO payment_method (name) VALUES ('$name')";
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay về danh sách
    header("location: ../index.php?action=quanlyphuongthucthanhtoan");
?>