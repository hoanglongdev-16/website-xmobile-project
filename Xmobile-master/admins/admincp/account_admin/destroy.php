<?php
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Lấy id
    $id = $_GET['id'];
    //Viết sql
    $sql_admin = "DELETE FROM admin WHERE id = '$id'";
    //Chạy sql
    $result_admin = mysqli_query($connection, $sql_admin);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay lại danh sách
    header("Location: ../index.php?action=quanlytaikhoanadmin");
?>