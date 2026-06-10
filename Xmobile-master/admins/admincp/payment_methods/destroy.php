<?php
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Lấy id
    $id = $_GET['id'];
    //Viết sql
    $sql = "DELETE FROM payment_method WHERE Id = '$id'";
    //Chạy sql
    $result = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay lại danh sách
    header("Location: ../index.php?action=quanlyphuongthucthanhtoan");
?>