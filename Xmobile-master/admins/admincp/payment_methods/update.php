<?php
    //Lấy dữ liệu từ form
    $id = $_POST["id"];
    $name = $_POST["name"];
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Viết sql
    $sql = "UPDATE payment_method SET name='$name' WHERE id='$id'";
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay về danh sách
    header("Location: ../index.php?action=quanlyphuongthucthanhtoan");
?>