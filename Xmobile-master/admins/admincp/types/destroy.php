<?php
    //Mở kết nối
    include_once "../../../Connection/open.php";
    //Lấy id
    $id = $_GET['id'];
    //Viết sql
    $sql_types = "DELETE FROM types WHERE id = '$id'";
    //Chạy sql
    $result_types = mysqli_query($connection, $sql_types);
    //Đóng kết nối
    include_once "../../../Connection/close.php";
    //Quay lại danh sách
    header("Location: ../index.php?action=quanlyphanloaisp");
?>