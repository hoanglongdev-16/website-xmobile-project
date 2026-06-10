<?php
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Lấy id
    $id = $_GET['id'];
    //Viết sql
    $sql_brands = "DELETE FROM brands WHERE id = '$id'";
    //Chạy sql
    $result_brands = mysqli_query($connection, $sql_brands);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay lại danh sách
    header("Location: ../index.php?action=quanlythuonghieu");
?>