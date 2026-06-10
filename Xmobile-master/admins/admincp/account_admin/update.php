<?php
    // Lấy dữ liệu trong form
    $id = $_POST["id"];
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    // Mở kết nối
    include_once "../../../Connection/open.php";

    // Kiểm tra xem email đã tồn tại chưa (loại trừ chính bản ghi đang sửa)
    $checkEmail = "SELECT *, COUNT(Id) AS count_id FROM admin WHERE Email = '$email' AND Id != '$id'";
    $results = mysqli_query($connection, $checkEmail);
    foreach ($results as $result) {
        if ($result['count_id'] == 0) {
            // Viết sql để cập nhật
            $sql = "UPDATE admin SET Name = '$name', Email = '$email', Password = '$password' WHERE Id = '$id'";
            // Chạy sql
            mysqli_query($connection, $sql);
            // Quay về danh sách
            header("location: ../index.php?action=quanlytaikhoanadmin");
        } else {
            // Email đã tồn tại
            echo "<script>
                alert('Email đã tồn tại! Vui lòng sử dụng email khác!');
                window.location.href = '../index.php?action=quanlytaikhoanadmin';
            </script>";      
        }
    }

    // Đóng kết nối
    include_once "../../../Connection/close.php";
?>
